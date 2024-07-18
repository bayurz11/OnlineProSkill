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

        $outputfile = public_path() . '/sertifikat.pdf';
        $this->fillPDF(public_path() . '/master/sertifikat.pdf', $outputfile, $name);

        return response()->download($outputfile);
    }

    public function fillPDF($file, $outputfile, $name)
    {
        $fpdi = new FPDI;
        $fpdi->setSourceFile($file);
        $template = $fpdi->importPage(1);
        $size = $fpdi->getTemplateSize($template);
        $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
        $fpdi->useTemplate($template);

        // Posisi dan pengaturan teks
        $top = 105;
        $right = 135;
        $fpdi->SetFont("helvetica", "", 17);
        $fpdi->SetTextColor(25, 26, 25);
        $fpdi->Text($right, $top, $name);

        $fpdi->Output($outputfile, 'F');
    }
}
