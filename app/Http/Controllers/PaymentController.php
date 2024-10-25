<?php

namespace App\Http\Controllers;

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
use Xendit\Invoice\InvoiceCallback;

class PaymentController extends Controller
{

    public function __construct()
    {
        $xenditApiKey = env('XENDIT_API_KEY');
        Configuration::setXenditKey($xenditApiKey);
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
                $totalAmount += $kelas->discountedPrice;
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

    // public function handleXenditWebhook(Request $request)
    // {
    //     // Ambil data dari webhook
    //     $data = $request->all();

    //     // Periksa apakah 'external_id' ada dalam data yang diterima
    //     if (!isset($data['external_id'])) {
    //         return response()->json(['message' => 'Invalid data'], 400);
    //     }

    //     $externalId = $data['external_id'];
    //     $status = $data['status'] ?? 'pending'; // Gunakan status default jika tidak ada
    //     $invoiceUrl = $data['invoice_url'] ?? null;

    //     // Cari order berdasarkan external_id
    //     $order = Order::where('external_id', $externalId)->first();

    //     if ($order) {
    //         // Update status order berdasarkan status invoice
    //         switch ($status) {
    //             case 'PAID':
    //                 $order->status = 'paid';
    //                 // Tambahkan langkah setelah pembayaran diterima, jika diperlukan
    //                 break;
    //             case 'EXPIRED':
    //                 $order->status = 'expired';
    //                 break;
    //             case 'FAILED':
    //                 $order->status = 'failed';
    //                 break;
    //             case 'SETTLED':
    //                 $order->status = 'settled'; // Status ketika invoice sudah settle
    //                 break;
    //             case 'CANCELED':
    //                 $order->status = 'canceled';
    //                 break;
    //             default:
    //                 $order->status = 'pending';
    //                 break;
    //         }

    //         // Perbarui link invoice jika tersedia
    //         if ($invoiceUrl) {
    //             $order->checkout_link = $invoiceUrl;
    //         }

    //         $order->save();

    //         return response()->json(['message' => 'Order updated successfully']);
    //     }

    //     return response()->json(['message' => 'Order not found'], 404);
    // }
    public function handleXenditWebhook(Request $request)
    {
        // Ambil data dari webhook
        $data = $request->all();

        // Periksa apakah 'external_id' ada dalam data yang diterima
        if (!isset($data['external_id'])) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $externalId = $data['external_id'];
        $status = $data['status'] ?? 'pending'; // Gunakan status default jika tidak ada
        $invoiceUrl = $data['invoice_url'] ?? null;

        // Cari order berdasarkan external_id
        $order = Order::where('external_id', $externalId)->first();

        if ($order) {
            // Update status order berdasarkan status invoice
            switch ($status) {
                case 'PAID':
                    $order->status = 'paid';
                    $notificationMessage = "Order {$order->id} has been paid.";
                    break;
                case 'EXPIRED':
                    $order->status = 'expired';
                    $notificationMessage = "Order {$order->id} has expired.";
                    break;
                case 'FAILED':
                    $order->status = 'failed';
                    $notificationMessage = "Order {$order->id} payment failed.";
                    break;
                case 'SETTLED':
                    $order->status = 'settled'; // Status ketika invoice sudah settle
                    $notificationMessage = "Order {$order->id} is settled.";
                    break;
                case 'CANCELED':
                    $order->status = 'canceled';
                    $notificationMessage = "Order {$order->id} has been canceled.";
                    break;
                default:
                    $order->status = 'pending';
                    $notificationMessage = "Order {$order->id} is pending.";
                    break;
            }

            // Perbarui link invoice jika tersedia
            if ($invoiceUrl) {
                $order->checkout_link = $invoiceUrl;
            }

            // Tandai order untuk user terkait bahwa notifikasi baru tersedia
            $order->notification_read = false; // Misal kolom ini ada untuk menandai notifikasi baru
            $order->save();

            // Kamu juga bisa menyimpan notifikasi dalam tabel terpisah jika diinginkan
            // Notification::create([...]);

            return response()->json(['message' => 'Order updated and notification created successfully']);
        }

        return response()->json(['message' => 'Order not found'], 404);
    }




    public function success($uuid)
    {
        // Cek apakah status sudah diperbarui oleh webhook
        $orders = Order::where('external_id', $uuid)->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Pesanan tidak ditemukan.');
        }

        foreach ($orders as $order) {
            if ($order->status == 'settled' || $order->status == 'paid') {
                // Jika status sudah settled atau paid, proses sukses
                session()->forget('cart');

                Notifikasiuser::create([
                    'user_id' => $order->user_id,
                    'status' => 1,
                    'message' => 'Pembayaran berhasil diproses'
                ]);

                return redirect()->route('akses_pembelian')->with('success', 'Pembayaran berhasil diproses');
            } elseif ($order->status == 'pending') {
                // Jika status masih pending, lakukan pengecekan manual ke API Xendit
                $apiInstance = new InvoiceApi();
                $result = $apiInstance->getInvoices(null, $uuid);

                // Update status dari API jika perlu
                $order->status = $result[0]['status'];
                $order->save();

                if ($order->status == 'settled') {
                    session()->forget('cart');

                    Notifikasiuser::create([
                        'user_id' => $order->user_id,
                        'status' => 1,
                        'message' => 'Pembayaran berhasil diproses'
                    ]);

                    return redirect()->route('akses_pembelian')->with('success', 'Pembayaran berhasil diproses');
                }
            }
        }

        session()->forget('cart');

        NotifikasiUser::create([
            'user_id' => $orders->first()->user_id,
            'status' => 1,
            'message' => 'Pembayaran berhasil'
        ]);

        return redirect()->route('akses_pembelian')->with('success', 'Pembayaran berhasil');
    }


    // public function success($uuid)
    // {
    //     $apiInstance = new InvoiceApi();
    //     $result = $apiInstance->getInvoices(null, $uuid);

    //     $orders = Order::where('external_id', $uuid)->get();

    //     if ($orders->isEmpty()) {
    //         return redirect()->route('cart.view')->with('error', 'Pesanan tidak ditemukan.');
    //     }

    //     foreach ($orders as $order) {

    //         $order->status = $result[0]['status'];
    //         $order->save();

    //         if ($order->status == 'SETTLED') {

    //             session()->forget('cart');

    //             Notifikasiuser::create([
    //                 'user_id' => $order->user_id,
    //                 'status' => 1,
    //                 'message' => 'Pembayaran berhasil di proses'
    //             ]);

    //             return redirect()->route('akses_pembelian')->with('success', 'Pembayaran berhasil di proses');
    //         }
    //     }

    //     session()->forget('cart');

    //     NotifikasiUser::create([
    //         'user_id' => $orders->first()->user_id,
    //         'status' => 1,
    //         'message' => 'Pembayaran Berhasil'
    //     ]);

    //     return redirect()->route('akses_pembelian')->with('success', 'Pembayaran Berhasil');
    // }
}
