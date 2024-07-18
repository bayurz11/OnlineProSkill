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
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }

        $profile = UserProfile::where('user_id', $user->id)->first();
        $name = $profile ? $profile->name : $user->name;

        $outputfile = public_path() . 'sertifikat.pdf';
        $this->fillPDF(public_path() . '/master/sertifikat.pdf', $outputfile, $name);

        return response()->download($outputfile);
    }

    public function fillPDF($file, $outputfile, $name)
    {
        $pdf = new Fpdi();

        $pdf->AddPage('L', [2000, 1414]);
        $pdf->setSourceFile($file);
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId, 0, 0, 2000, 1414);

        $pdf->SetFont('Helvetica', '', 48);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(1000, 707);
        $pdf->Cell(0, 0, $name, 0, 1, 'C');

        $pdf->Output('F', $outputfile);
    }
}
