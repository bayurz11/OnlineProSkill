<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'massage' => 'Ada Kesalahan',
                'data' => $validator->errors()
            ]);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        // Buat pengguna baru
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        // Kembalikan data pengguna dan token
        return response()->json([
            'success' => true,
            'massage' => 'Sukses Resgistrasi',
            'data' => $success
        ]);
    }
}
