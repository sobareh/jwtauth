<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\OTPCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VerifyOTPResource;

class VerifyOTPController extends Controller
{
    public function __invoke(Request $request)
    {
        $requestotp = request('otp');
        $otp_code = OTPCode::where('otp', $requestotp)->first();

        if (!$otp_code) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'OTP code tidak ditemukan',
            ], 401);
        }

        $now = Carbon::now();

        if ($now > $otp_code->valid_until) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'kode otp sudah tidak berlaku, silahkan generate ulang kembali.'
            ], 401);
        }

        $user = User::find($otp_code->user_id);
        $user->email_verified_at = $now;
        $user->save();
        
        $otp_code->delete();
        $data["user"] = $user;

        return new VerifyOTPResource($user);
    }
}
