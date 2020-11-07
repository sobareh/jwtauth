<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\OTPCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NewOTPResource;

class RegenerateOTPController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
       $user = User::where('email', $request->email)->first();

       if (!$user) {
           return response()->json([
               "response_code" => "01",
               "response_message" => "Data Pengguna atau Email tidak ditemukan. Silahkan Register terlebih dahulu."
           ]);
       }    

       $time = new Carbon;
       $datatime = $time->now()->addMinutes(15);

       $newOTP = OTPCode::find($user->id);
       $newOTP->otp = rand(100000, 999999);
       $newOTP->valid_until = $datatime;
       $newOTP->save();

       return new NewOTPResource($user);  
    }
}
