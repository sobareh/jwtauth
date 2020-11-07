<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
      $request->validate([
          'email' => 'required',
          'password' => 'required'
      ]);

      $user = User::where('email', $request->email)->first();

      if (!$user) {
          return response()->json([
              'response_code' => '01',
              'response_message' => 'Data Pengguna atau Email tidak ditemukan. Silahkan Register terlebih dahulu.',
          ], 401);
      }

      if (!$user->email_verified_at) {
          return response()->json([
              'response_code' => '01',
              'response_message' => 'Data Pengguna atau Email belum diaktivasi. Silahkan Aktivasi via OTP terlebih dahulu.'
          ], 401);
      }

      if (!$user->password) {
          return response()->json([
              'response_code' => '01',
              'response_message' => 'Data Pengguna atau Email belum membuat password. Silahkan buat password terlebih dahulu.'
          ], 401);
      }

      if (!$token = auth()->attempt($request->only('email', 'password'))) {
        return response()->json([
              'response_code' => '01',
              'response_message' => 'Gagal melakukan proses autentikasi. Mohon untuk mengisi email & password dengan benar.'
          ], 401);
      }

      return new LoginResource($user);
    }
}
