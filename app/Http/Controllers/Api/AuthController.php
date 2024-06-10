<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // public function register(Request $request)
    // {
    //     // Validasi data yang diterima
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('registrasi')->withErrors($validator)->withInput();
    //     }

    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);

    //     $success['token'] = $user->createToken('auth_token')->plainTextToken;
    //     $success['name'] = $user->name;

    //     // Kembalikan data pengguna dan token
    //     return redirect()->route('login')->with([
    //         'success' => true,
    //         'message' => 'Sukses Registrasi',
    //         'data' => $success
    //     ]);
    // }

    public function register(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrasi')->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // Menambahkan peran pengguna
        $userRole = new UserRoles();
        $userRole->user_id = $user->id;
        $userRole->role_id = 1; // Sesuaikan dengan ID peran yang sesuai
        $userRole->save();

        // Menambahkan profil pengguna
        $userProfile = new UserProfile();
        $userProfile->user_id = $user->id; // Masukkan user_id baru
        $userProfile->role_id = 1; // Sesuaikan dengan ID peran yang sesuai
        $userProfile->save();

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        // Kembalikan data pengguna dan token
        return redirect()->route('login')->with([
            'success' => true,
            'message' => 'Sukses Registrasi',
            'data' => $success
        ]);
    }

    // public function login(Request $request)
    // {
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $auth = Auth::user();
    //         $success['token'] = $auth->createToken('auth_token')->plainTextToken;
    //         $success['name'] = $auth->name;
    //         $success['email'] = $auth->email;
    //         return response()->json([
    //             'success' => true,
    //             'massage' => 'Login Sukses',
    //             'data' => $success
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'massage' => 'Cek Email Dan Password Anda',
    //             'data' => null
    //         ]);
    //     }
    // }
    // public function login(Request $request)
    // {
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $auth = Auth::user();
    //         $success['token'] = $auth->createToken('auth_token')->plainTextToken;
    //         $success['name'] = $auth->name;
    //         $success['email'] = $auth->email;
    //         return redirect()->route('dashboard');
    //     } else {
    //         return redirect()->route('login')->withErrors([
    //             'email' => 'Cek Email Anda',
    //             'Password' => 'Cek Password Anda',
    //         ]);
    //     }
    // }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['email'] = $auth->email;

            // Assuming the user role is obtained like this
            $userRole = $auth->userRole;

            // If the user does not have a role
            if (!$userRole) {
                return redirect()->back()->with('error', 'Pengguna tidak memiliki peran yang ditetapkan!');
            }

            // Get the role name
            $roleName = $userRole->role->role_name;
            $userName = $auth->name;

            // Redirect based on user role
            switch ($roleName) {
                case 'Administrator':
                    return redirect()->route('dashboard')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Studen':
                    return redirect()->route('dashboard_siswa')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                case 'Instruktur':
                    return redirect()->route('dashboard_instruktur')->with('success', "Selamat datang, $userName! Anda berhasil masuk.");
                default:
                    return redirect()->route('/')->with('error', 'Peran pengguna tidak dikenali.');
            }
        } else {
            return redirect()->route('login')->with('error', 'email atau password anda salah.');
        }
    }



    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
