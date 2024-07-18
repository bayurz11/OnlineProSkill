<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\UserProfile;
use App\Models\NotifikasiUser;
use App\Models\Order;
use setasign\Fpdi\Fpdi;

class SertifikatController extends Controller
{
    public function cetak(Request $request)
    {
        Log::info('Method cetak dipanggil');
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $name = $profile ? $profile->name : $user->name;

        $outputfile = public_path() . '/sertifikat.pdf';
        $this->fillPDF(public_path() . '/master/sertifikat.pdf', $outputfile, $name);

        return response()->download($outputfile);
    }

    public function fillPDF($sourcefile, $outputfile, $name)
    {
        // Inisialisasi FPDI
        $pdf = new FPDI();

        // Tambahkan halaman dari PDF master
        $pdf->AddPage();
        $pdf->setSourceFile($sourcefile);
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx, 0, 0, 210);

        // Set font dan ukuran font
        $pdf->SetFont('Helvetica', '', 24);

        // Tentukan posisi untuk menulis nama pada sertifikat
        $pdf->SetXY(50, 100); // Ubah posisi sesuai dengan kebutuhan Anda

        // Tulis nama ke PDF
        $pdf->Cell(0, 10, $name, 0, 1, 'C');

        // Simpan output file
        $pdf->Output($outputfile, 'F');
    }
}
