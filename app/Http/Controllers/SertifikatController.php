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

    protected function fillPDF($file, $outputfile, $name)
    {
        $pdf = new FPDI();

        $pageCount = $pdf->setSourceFile($file);
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $pdf->AddPage();
            $pdf->useTemplate($templateId, 10, 10, 200);

            $pdf->SetFont('Helvetica');
            $pdf->SetXY(50, 100); // Sesuaikan posisi nama di sertifikat
            $pdf->Write(0, $name);
        }

        $pdf->Output($outputfile, 'F');
    }
}
