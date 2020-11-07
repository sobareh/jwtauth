<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UpdatePasswordResource;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:8', 'string'],
            'password_confirmation' => ['required', 'same:password'],  
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

        $user->password = bcrypt($request->password);
        $user->save();

        return new UpdatePasswordResource($user);
    }
}
