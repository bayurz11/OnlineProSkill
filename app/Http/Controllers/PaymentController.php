<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\Order;
use Xendit\Configuration;
use App\Models\Sertifikat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use App\Models\NotifikasiUser;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends Controller
{

    public function __construct()
    {

        // Configuration::setXenditKey("");
    }

    public function payment(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable',
            'cart_items' => 'required|array',
            'biaya_pendaftaran' => 'required|numeric',
        ]);

        // Ambil user ID
        $userId = Auth::id();
        $uuid = (string) Str::uuid();

        // Hitung total harga
        $totalAmount = 0;
        $items = [];
        $classNames = [];

        foreach ($request->cart_items as $itemId) {
            // Cek apakah user sudah membeli kelas ini
            $existingOrder = Order::where('user_id', $userId)
                ->where('product_id', $itemId)
                ->where('status', '!=', 'canceled') // Asumsikan bahwa status 'canceled' berarti transaksi dibatalkan
                ->first();

            if ($existingOrder) {
                return redirect()->back()->with('error', 'Anda sudah membeli kelas ini: ' . KelasTatapMuka::find($itemId)->nama_kursus);
            }

            // Jika belum, tambahkan ke daftar item
            $kelas = KelasTatapMuka::find($itemId);
            if ($kelas) {
                $totalAmount += $kelas->price;
                $items[] = $kelas;
                $classNames[] = $kelas->nama_kursus; // Asumsikan bahwa nama kelas ada di properti 'nama_kursus'
            }
        }

        if (empty($items)) {
            return redirect()->back()->with('error', 'Tidak ada kelas yang valid di keranjang.');
        }
        // Tambahkan biaya pendaftaran ke total
        $biayaPendaftaran = $request->input('biaya_pendaftaran');
        $totalAmount += $biayaPendaftaran;

        // Gabungkan nama-nama kelas menjadi satu string untuk deskripsi
        $description = "Pembelian Kelas: " . implode(', ', $classNames);

        // Panggil Xendit
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $uuid,
            'description' => $description,
            'amount' => $totalAmount,
            'currency' => 'IDR',
            "customer" => [
                "given_names" => $request->name,
                "email" => $request->email,
                "mobile_number" => $request->phone,
            ],
            "success_redirect_url" => route('success', ['uuid' => $uuid]),
            "failure_redirect_url" => route('cart.view'), // Arahkan ke halaman Cart jika gagal
        ]);

        try {
            $result = $apiInstance->createInvoice($createInvoiceRequest);

            // Generate nomor invoice unik
            $invoiceNumber = 'PSA-' . Carbon::now('Asia/Jakarta')->format('mdHi') . '-' . $userId;

            // Format bulan dan tahun
            $bulanTahun = Carbon::now()->format('m.Y'); // contoh: 082024

            // Ambil nama user berdasarkan userId
            $userName = Auth::user()->name;

            // Masukkan ke tabel orders
            foreach ($items as $kelas) {
                $order = new Order();
                $order->user_id = $userId;
                $order->product_id = $kelas->id;
                $order->checkout_link = $result['invoice_url'];
                $order->external_id = $uuid;
                $order->status = "pending";
                $order->price = $totalAmount;
                $order->nomor_invoice = $invoiceNumber; // Tambahkan nomor invoice
                $order->save();

                // Ambil nama_kursus dan ambil inisial
                $namaKursus = $kelas->nama_kursus;
                $inisialNamaKursus = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $namaKursus)));

                // Cek apakah user_id ada di tabel Sertifikat
                $certificate = Sertifikat::where('user_id', $userId)->first();

                // Periksa apakah ada data sertifikat dengan product_id, sertifikat_id, dan checkout_link yang sudah terisi
                $isAllFilled = $certificate && $certificate->product_id && $certificate->sertifikat_id && $certificate->link;

                if ($isAllFilled) {
                    // Jika semua data sudah terisi, buat entri baru di tabel Sertifikat
                    $newCertificate = new Sertifikat();
                    $newCertificate->user_id = $userId;
                    $newCertificate->name = $userName; // Tambahkan nama user
                    $newCertificate->product_id = $kelas->id;
                    $newCertificate->save();

                    // Update sertifikat_id setelah ID sertifikat tersedia
                    $certificateIdFormatted = str_pad($newCertificate->id, 3, '0', STR_PAD_LEFT);
                    $newCertificate->sertifikat_id = $certificateIdFormatted . '/PSA/' . $inisialNamaKursus . '/' . $bulanTahun;
                    $newCertificate->link = url("/print/{$newCertificate->id}"); // Tambahkan link cetak sertifikat
                    $newCertificate->save();
                } else {
                    if ($certificate) {
                        // Jika ada sertifikat, tambahkan product_id ke tabel Sertifikat
                        $certificate->product_id = $kelas->id;
                        // Format sertifikat_id menggunakan ID Sertifikat yang dipad menjadi 3 angka dan inisial nama kursus
                        $certificateIdFormatted = str_pad($certificate->id, 3, '0', STR_PAD_LEFT);
                        $certificate->sertifikat_id = $certificateIdFormatted . ' / PSA / ' . $inisialNamaKursus . ' / ' . $bulanTahun;
                        $certificate->link = url("/print/{$certificate->id}"); // Tambahkan link cetak sertifikat
                        $certificate->save();
                    } else {
                        // Jika tidak ada, buat entri baru di tabel Sertifikat
                        $newCertificate = new Sertifikat();
                        $newCertificate->user_id = $userId;
                        $newCertificate->name = $userName;
                        $newCertificate->product_id = $kelas->id;
                        $newCertificate->save();

                        // Update sertifikat_id setelah ID sertifikat tersedia
                        $certificateIdFormatted = str_pad($newCertificate->id, 3, '0', STR_PAD_LEFT);
                        $newCertificate->sertifikat_id = $certificateIdFormatted . '/PSA/' . $inisialNamaKursus . '/' . $bulanTahun;
                        $newCertificate->link = url("/print/{$newCertificate->id}"); // Tambahkan link cetak sertifikat
                        $newCertificate->save();
                    }
                }
            }

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            return redirect()->back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }



    public function success($uuid)
    {
        $apiInstance = new InvoiceApi();
        $result = $apiInstance->getInvoices(null, $uuid);

        $orders = Order::where('external_id', $uuid)->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Pesanan tidak ditemukan.');
        }

        foreach ($orders as $order) {

            $order->status = $result[0]['status'];
            $order->save();

            if ($order->status == 'SETTLED') {

                session()->forget('cart');

                Notifikasiuser::create([
                    'user_id' => $order->user_id,
                    'status' => 1,
                    'message' => 'Pembayaran berhasil di proses'
                ]);

                return redirect()->route('akses_pembelian')->with('success', 'Pembayaran berhasil di proses');
            }
        }

        session()->forget('cart');

        NotifikasiUser::create([
            'user_id' => $orders->first()->user_id,
            'status' => 1,
            'message' => 'Pembayaran Berhasil'
        ]);

        return redirect()->route('akses_pembelian')->with('success', 'Pembayaran Berhasil');
    }

    public function handleWebhook(Request $request)
    {

        Log::info('Webhook received', $request->all());
        // Validasi dan ambil data dari webhook
        $data = $request->all();

        // Pastikan event yang diterima adalah pembayaran
        if (isset($data['event']) && $data['event'] === 'payment_success') {
            $externalId = $data['data']['external_id'];
            $status = $data['data']['status'];

            // Cari semua pesanan berdasarkan external_id
            $orders = Order::where('external_id', $externalId)->get();

            // Periksa jika ada pesanan yang ditemukan
            if ($orders->isEmpty()) {
                return response()->json(['status' => 'no orders found'], 404);
            }

            foreach ($orders as $order) {
                // Update status pesanan
                $order->status = $status; // SETTLED
                $order->save();

                // Jika pembayaran berhasil, buat notifikasi untuk user
                NotifikasiUser::create([
                    'user_id' => $order->user_id,
                    'status' => 1,
                    'message' => 'Pembayaran berhasil untuk pesanan ' . $order->nomor_invoice,
                ]);
            }

            // Balas Xendit dengan status 200 OK
            return response()->json(['status' => 'success'], 200);
        }

        // Jika event adalah pembayaran gagal
        if (isset($data['event']) && $data['event'] === 'payment_failed') {
            // ... logika yang sama untuk pembayaran gagal
        }

        // Jika tidak ada event yang dikenali
        return response()->json(['status' => 'event not recognized'], 400);
    }
}
