<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Xendit\Configuration;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
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
    public function payment(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Ambil data produk
        $klsoffline = KelasTatapMuka::find($request->id);
        if (!$klsoffline) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        // Ambil user ID
        $userId = Auth::id();

        $uuid = (string) Str::uuid();

        // Panggil Xendit
        $apiInstance = new InvoiceApi();
        $createInvoiceRequest = new CreateInvoiceRequest([
            'external_id' => $uuid,
            'description' => $klsoffline->description,
            'amount' => $klsoffline->price,
            'currency' => 'IDR',
            "customer" => [
                "given_names" => $request->name,
                "email" => $request->email,
                "mobile_number" => $request->phone,
            ],
            "success_redirect_url" => route('success', ['uuid' => $uuid]),
            "failure_redirect_url" => route('checkout', ['id' => $request->id]),
        ]);

        try {
            $result = $apiInstance->createInvoice($createInvoiceRequest);

            // Masukkan ke tabel orders
            $order = new Order();
            $order->user_id = $userId;  // Tambahkan user ID
            $order->product_id = $klsoffline->id;
            $order->checkout_link = $result['invoice_url'];
            $order->external_id = $uuid;
            $order->status = "pending";
            $order->save();

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            return redirect()->back()->with('error', 'Pembayaran gagal. Silakan coba lagi.');
        }
    }

    public function success($uuid)
    {
        $apiInstance = new InvoiceApi();

        $result = $apiInstance->getInvoices(null, $uuid);

        //get data
        $klsoffline = Order::where('external_id', $uuid)->firstOrFail();

        if ($klsoffline->status == 'settled') {
            return response()->json('Pembayaran berhasil di proses');
        }
        //update status
        $klsoffline->status = $result[0]['status'];
        $klsoffline->save();
        return redirect()->route('classroom')->with('success', 'Pembayaran Berhasil');
    }
}
