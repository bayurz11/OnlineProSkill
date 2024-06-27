<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('/');
        }
        return view('studen.setting', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'dateofBirth' => 'required|date',
            'gender' => 'required|string',
            'phonenumber' => 'required|string',
            'alamat' => 'required|string',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'website' => 'nullable|url',
            'github' => 'nullable|url',
        ]);

        $user->date_of_birth = $request->input('dateofBirth');
        $user->gender = $request->input('gender');
        $user->phone_number = $request->input('phonenumber');
        $user->address = $request->input('alamat');
        $user->bio = $request->input('bio');
        $user->facebook = $request->input('facebook');
        $user->twitter = $request->input('twitter');
        $user->linkedin = $request->input('linkedin');
        $user->website = $request->input('website');
        $user->github = $request->input('github');

        if ($request->hasFile('fileInput')) {
            $request->validate(['fileInput' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            $file = $request->file('fileInput');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pictures'), $filename);
            $user->profile_picture = $filename;
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'currentpassword' => 'required|string',
            'newpassword' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->input('currentpassword'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        $user->password = Hash::make($request->input('newpassword'));
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
