<?php

namespace App\Http\Controllers\Auth;

use App\OTPCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerifyOTPController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        $request_kode_otp = request('otp_code');
        
        $otp = new OTPCode;
        $dataotp = $otp->find(auth()->user()->id);
        $match_kode_otp = $dataotp->kode_otp;
        $match_user_id_otp = $dataotp->user_id;


        if (auth()->user()->id === $match_user_id_otp && $match_kode_otp === $request_kode_otp) {
            return response()->json("your OTP code is valid.");       
        } else {
            return response("your OTP code is invalid", 401);
        }

    }
}
