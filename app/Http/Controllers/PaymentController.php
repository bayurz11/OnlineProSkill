<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Xendit\Configuration;
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

            // Masukkan ke tabel orders
            foreach ($items as $kelas) {
                $order = new Order();
                $order->user_id = $userId;
                $order->product_id = $kelas->id;
                $order->checkout_link = $result['invoice_url'];
                $order->external_id = $uuid;
                $order->status = "pending";
                $order->price = $kelas->price;
                $order->nomor_invoice = $invoiceNumber; // Tambahkan nomor invoice
                $order->save();
            }

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            return redirect()->back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }


    // public function success($uuid)
    // {
    //     $apiInstance = new InvoiceApi();
    //     $result = $apiInstance->getInvoices(null, $uuid);

    //     // Ambil semua pesanan yang cocok dengan external_id
    //     $orders = Order::where('external_id', $uuid)->get();

    //     if ($orders->isEmpty()) {
    //         return redirect()->route('cart.view')->with('error', 'Pesanan tidak ditemukan.');
    //     }

    //     foreach ($orders as $order) {
    //         if ($order->status == 'settled') {
    //             // Mengosongkan cart di dalam session
    //             session()->forget('cart');

    //             // Tambahkan notifikasi untuk pengguna
    //             Notifikasiuser::create([
    //                 'user_id' => $order->user_id,
    //                 'status' => 1,
    //                 'message' => 'Pembayaran berhasil di proses'
    //             ]);

    //             return response()->json('Pembayaran berhasil di proses');
    //         }

    //         //update status
    //         $order->status = $result[0]['status'];
    //         $order->save();
    //     }

    //     // Mengosongkan cart di dalam session
    //     session()->forget('cart');

    //     // Tambahkan notifikasi untuk pengguna
    //     NotifikasiUser::create([
    //         'user_id' => $orders->first()->user_id,
    //         'status' => 1,
    //         'message' => 'Pembayaran Berhasil'
    //     ]);

    //     return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    // } 11-07-24
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
}
