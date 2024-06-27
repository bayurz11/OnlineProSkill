<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Xendit\Configuration;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Http\Controllers\Controller;
use App\Models\KelasTatapMuka;
use Xendit\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        Configuration::setXenditKey("xnd_development_Dk99ZuALmDeKEquMQlyWZDozXzyOMFayljkE46Z3dVHhkIBMLGygOzEgwOXYhaa");
        // Configuration::setXenditKey("xnd_production_1X2OuC1am3i41Q3y4ljRGCJzI01eUz0gQyIFucfMbJXXIsO5HozEabDP3AHxr"); //LIVE
    }

    public function payment(Request $request)
    {
        // Validate request
        $request->validate([
            'id' => 'required',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        // Fetch product data
        $klsoffline = KelasTatapMuka::find($request->id);
        $uuid = (string) Str::uuid();

        // Call Xendit
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
            "success_redirect_url" => "https://testproskill.proskill.sch.id/succes/{$uuid}",
            "failure_redirect_url" => "http://127.0.0.1:8000",
        ]);

        try {
            $result = $apiInstance->createInvoice($createInvoiceRequest);

            // Insert into orders table
            $order = new Order();
            $order->product_id = $klsoffline->id;
            $order->checkout_link = $result['invoice_url'];
            $order->external_id = $uuid;
            $order->status = "pending";
            $order->save();

            return redirect($result['invoice_url']);
        } catch (\Xendit\XenditSdkException $e) {
            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        }
    }
}
