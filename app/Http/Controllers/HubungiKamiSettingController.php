<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HubungiKamiSettingController extends Controller
{
    public function index()
    {
        $contactUs = ContactUs::all();
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('/');
        }

        return view('admin.PengaturanUmum.contactUs', compact('user', 'contactUs'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'alamat' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:15', // assuming these are phone numbers
            'email' => 'nullable|email|max:255',
        ]);

        // Create a new ContactUs record
        $contactUs = new ContactUs();
        $contactUs->alamat = $request->input('alamat');
        $contactUs->telepon = json_encode($request->input('telepon')); // Store as JSON array
        $contactUs->email = json_encode($request->input('email')); // Store as JSON array
        $contactUs->save();

        // Redirect or respond with a success message
        return redirect()->back()->with('success', 'Contact information saved successfully!');
    }

    public function edit($id)
    {
        $contactUs = ContactUs::find($id);

        if (!$contactUs) {
            return response()->json(['message' => 'contactUs not found'], 404);
        }

        return response()->json($contactUs);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'alamat' => 'required|string|max:255',
            'include.*' => 'nullable|string|max:15', // Validasi untuk telepon
            'includemail.*' => 'nullable|email|max:255', // Validasi untuk email
        ]);

        // Temukan ContactUs berdasarkan ID
        $contactUs = ContactUs::findOrFail($id);

        // Update data
        $contactUs->alamat = $request->input('alamat');
        $contactUs->telepon = json_encode($request->input('include')); // Simpan sebagai array JSON
        $contactUs->email = json_encode($request->input('includemail')); // Simpan sebagai array JSON
        $contactUs->save();

        // Redirect dengan pesan sukses
        return redirect()->route('settingcontactus')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {

        $contactUs = ContactUs::find($id);

        if (!$contactUs) {
            return redirect()->route('settingcontactus')->with('error', 'Data tidak ditemukan');
        }

        $contactUs->delete();

        return redirect()->route('settingcontactus')->with('success', 'Data berhasil dihapus');
    }
}
