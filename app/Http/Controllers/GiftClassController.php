<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sertifikat;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KelasTatapMuka;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GiftClassController extends Controller
{
    public function giftClass(Request $request)
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

        // Atur total harga menjadi 0
        $totalAmount = 0;
        $items = [];
        $classNames = [];

        foreach ($request->cart_items as $itemId) {
            // Cek apakah user sudah memiliki kelas ini
            $existingOrder = Order::where('user_id', $userId)
                ->where('product_id', $itemId)
                ->where('status', '!=', 'canceled')
                ->first();

            if ($existingOrder) {
                return redirect()->back()->with('error', 'Anda sudah memiliki kelas ini: ' . KelasTatapMuka::find($itemId)->nama_kursus);
            }

            // Jika belum, tambahkan ke daftar item
            $kelas = KelasTatapMuka::find($itemId);
            if ($kelas) {
                $items[] = $kelas;
                $classNames[] = $kelas->nama_kursus;
            }
        }

        if (empty($items)) {
            return redirect()->back()->with('error', 'Tidak ada kelas yang valid di keranjang.');
        }

        // Gabungkan nama-nama kelas menjadi satu string untuk deskripsi
        $description = "Pemberian Kelas Gratis: " . implode(', ', $classNames);

        // Generate nomor invoice unik
        $invoiceNumber = 'PSA-' . Carbon::now('Asia/Jakarta')->format('mdHi') . '-' . $userId;

        // Format bulan dan tahun
        $bulanTahun = Carbon::now()->format('m.Y');

        // Ambil nama user berdasarkan userId
        $userName = Auth::user()->name;

        // Masukkan ke tabel orders
        foreach ($items as $kelas) {
            $order = new Order();
            $order->user_id = $userId;
            $order->product_id = $kelas->id;
            $order->checkout_link = null; // Tidak ada link pembayaran karena gratis
            $order->external_id = $uuid;
            $order->status = "granted"; // Status baru untuk menandakan kelas gratis
            $order->price = $totalAmount;
            $order->nomor_invoice = $invoiceNumber;
            $order->save();

            // Proses sertifikat seperti di fungsi sebelumnya
            $namaKursus = $kelas->nama_kursus;
            $inisialNamaKursus = implode('', array_map(fn($word) => strtoupper($word[0]), explode(' ', $namaKursus)));

            $certificate = Sertifikat::where('user_id', $userId)->first();
            $isAllFilled = $certificate && $certificate->product_id && $certificate->sertifikat_id && $certificate->link;

            if ($isAllFilled) {
                $newCertificate = new Sertifikat();
                $newCertificate->user_id = $userId;
                $newCertificate->name = $userName;
                $newCertificate->product_id = $kelas->id;
                $newCertificate->save();

                $certificateIdFormatted = str_pad($newCertificate->id, 3, '0', STR_PAD_LEFT);
                $newCertificate->sertifikat_id = $certificateIdFormatted . '/PSA/' . $inisialNamaKursus . '/' . $bulanTahun;
                $newCertificate->link = url("/print/{$newCertificate->id}");
                $newCertificate->save();
            } else {
                if ($certificate) {
                    $certificate->product_id = $kelas->id;
                    $certificateIdFormatted = str_pad($certificate->id, 3, '0', STR_PAD_LEFT);
                    $certificate->sertifikat_id = $certificateIdFormatted . ' / PSA / ' . $inisialNamaKursus . ' / ' . $bulanTahun;
                    $certificate->link = url("/print/{$certificate->id}");
                    $certificate->save();
                } else {
                    $newCertificate = new Sertifikat();
                    $newCertificate->user_id = $userId;
                    $newCertificate->name = $userName;
                    $newCertificate->product_id = $kelas->id;
                    $newCertificate->save();

                    $certificateIdFormatted = str_pad($newCertificate->id, 3, '0', STR_PAD_LEFT);
                    $newCertificate->sertifikat_id = $certificateIdFormatted . '/PSA/' . $inisialNamaKursus . '/' . $bulanTahun;
                    $newCertificate->link = url("/print/{$newCertificate->id}");
                    $newCertificate->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Kelas berhasil diberikan secara gratis.');
    }
}
