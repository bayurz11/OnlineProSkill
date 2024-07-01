<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
use App\Models\NotifikasiUser;
use Illuminate\Support\Facades\Auth;
use Xendit\Invoice\CreateInvoiceRequest;

class PaymentController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey("xnd_development_Dk99ZuALmDeKEquMQlyWZDozXzyOMFayljkE46Z3dVHhkIBMLGygOzEgwOXYhaa");
        // Configuration::setXenditKey("xnd_production_1X2OuC1am3i41Q3y4ljRGCJzI01eUz0gQyIFucfMbJXXIsO5HozEabDP3AHxr"); //LIVE
    }

    // public function payment(Request $request)
    // {
    //     // Validasi permintaan
    //     $request->validate([
    //         'id' => 'required',
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //     ]);

    //     // Ambil data produk
    //     $klsoffline = KelasTatapMuka::find($request->id);
    //     if (!$klsoffline) {
    //         return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
    //     }

    //     // Ambil user ID
    //     $userId = Auth::id();

    //     $uuid = (string) Str::uuid();

    //     // Panggil Xendit
    //     $apiInstance = new InvoiceApi();
    //     $createInvoiceRequest = new CreateInvoiceRequest([
    //         'external_id' => $uuid,
    //         'description' => $klsoffline->description,
    //         'amount' => $klsoffline->price,
    //         'currency' => 'IDR',
    //         "customer" => [
    //             "given_names" => $request->name,
    //             "email" => $request->email,
    //             "mobile_number" => $request->phone,
    //         ],
    //         "success_redirect_url" => route('success', ['uuid' => $uuid]),
    //         "failure_redirect_url" => route('checkout', ['id' => $request->id]),
    //     ]);

    //     try {
    //         $result = $apiInstance->createInvoice($createInvoiceRequest);

    //         // Masukkan ke tabel orders
    //         $order = new Order();
    //         $order->user_id = $userId;  // Tambahkan user ID
    //         $order->product_id = $klsoffline->id;
    //         $order->checkout_link = $result['invoice_url'];
    //         $order->external_id = $uuid;
    //         $order->status = "pending";
    //         $order->save();

    //         return redirect($result['invoice_url']);
    //     } catch (\Xendit\XenditSdkException $e) {
    //         return redirect()->back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    //     }
    // }

    // public function payment(Request $request)
    // {
    //     // Validasi permintaan
    //     $request->validate([
    //         'name' => 'required|string',
    //         'email' => 'required|email',
    //         'phone' => 'required',
    //         'cart_items' => 'required|array',
    //     ]);

    //     // Ambil user ID
    //     $userId = Auth::id();
    //     $uuid = (string) Str::uuid();
    //     $description = "Pembelian Kelas";

    //     // Hitung total harga
    //     $totalAmount = 0;
    //     $items = [];

    //     foreach ($request->cart_items as $itemId) {
    //         $kelas = KelasTatapMuka::find($itemId);
    //         if ($kelas) {
    //             $totalAmount += $kelas->price;
    //             $items[] = $kelas;
    //         }
    //     }

    //     if (empty($items)) {
    //         return redirect()->back()->with('error', 'Tidak ada kelas yang valid di keranjang.');
    //     }

    //     // Panggil Xendit
    //     $apiInstance = new InvoiceApi();
    //     $createInvoiceRequest = new CreateInvoiceRequest([
    //         'external_id' => $uuid,
    //         'description' => $description,
    //         'amount' => $totalAmount,
    //         'currency' => 'IDR',
    //         "customer" => [
    //             "given_names" => $request->name,
    //             "email" => $request->email,
    //             "mobile_number" => $request->phone,
    //         ],
    //         "success_redirect_url" => route('success', ['uuid' => $uuid]),
    //         "failure_redirect_url" => route('cart.view'), // Arahkan ke halaman Cart jika gagal
    //     ]);

    //     try {
    //         $result = $apiInstance->createInvoice($createInvoiceRequest);

    //         // Masukkan ke tabel orders
    //         foreach ($items as $kelas) {
    //             $order = new Order();
    //             $order->user_id = $userId;
    //             $order->product_id = $kelas->id;
    //             $order->checkout_link = $result['invoice_url'];
    //             $order->external_id = $uuid;
    //             $order->status = "pending";
    //             $order->save();
    //         }

    //         return redirect($result['invoice_url']);
    //     } catch (\Xendit\XenditSdkException $e) {
    //         return redirect()->back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    //     }
    // }

    public function payment(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
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
            $kelas = KelasTatapMuka::find($itemId);
            if ($kelas) {
                $totalAmount += $kelas->price;
                $items[] = $kelas;
                $classNames[] = $kelas->nama_kursus; // Asumsikan bahwa nama kelas ada di properti 'name'
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

            // Masukkan ke tabel orders
            foreach ($items as $kelas) {
                $order = new Order();
                $order->user_id = $userId;
                $order->product_id = $kelas->id;
                $order->checkout_link = $result['invoice_url'];
                $order->external_id = $uuid;
                $order->status = "pending";
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

    //     //get data
    //     $klsoffline = Order::where('external_id', $uuid)->firstOrFail();

    //     if ($klsoffline->status == 'settled') {
    //         return response()->json('Pembayaran berhasil di proses');
    //     }
    //     //update status
    //     $klsoffline->status = $result[0]['status'];
    //     $klsoffline->save();
    //     return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    // }

    // public function success($uuid)
    // {
    //     $apiInstance = new InvoiceApi();

    //     $result = $apiInstance->getInvoices(null, $uuid);

    //     //get data
    //     $order = Order::where('external_id', $uuid)->firstOrFail();

    //     if ($order->status == 'settled') {
    //         // Mengosongkan cart di dalam session
    //         session()->forget('cart');

    //         return response()->json('Pembayaran berhasil di proses');
    //     }

    //     //update status
    //     $order->status = $result[0]['status'];
    //     $order->save();

    //     // Mengosongkan cart di dalam session
    //     session()->forget('cart');

    //     return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    // } tgl290624

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
    //             return response()->json('Pembayaran berhasil di proses');
    //         }

    //         //update status
    //         $order->status = $result[0]['status'];
    //         $order->save();
    //     }

    //     // Mengosongkan cart di dalam session
    //     session()->forget('cart');

    //     return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    // }
    public function success($uuid)
    {
        $apiInstance = new InvoiceApi();
        $result = $apiInstance->getInvoices(null, $uuid);

        // Ambil semua pesanan yang cocok dengan external_id
        $orders = Order::where('external_id', $uuid)->get();

        if ($orders->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Pesanan tidak ditemukan.');
        }

        foreach ($orders as $order) {
            if ($order->status == 'settled') {
                // Mengosongkan cart di dalam session
                session()->forget('cart');

                // Tambahkan notifikasi untuk pengguna
                Notifikasiuser::create([
                    'user_id' => $order->user_id,
                    'status' => 1,
                    'message' => 'Pembayaran berhasil di proses'
                ]);

                return response()->json('Pembayaran berhasil di proses');
            }

            //update status
            $order->status = $result[0]['status'];
            $order->save();
        }

        // Mengosongkan cart di dalam session
        session()->forget('cart');

        // Tambahkan notifikasi untuk pengguna
        NotifikasiUser::create([
            'user_id' => $orders->first()->user_id,
            'status' => 1,
            'message' => 'Pembayaran Berhasil'
        ]);

        return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    }
}
