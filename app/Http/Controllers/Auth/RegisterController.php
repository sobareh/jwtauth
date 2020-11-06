<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\OTPCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
       $data = new User;
       $data->name = request('name');
       $data->email = request('email');
       $data->password = bcrypt(request('password'));
       $data->save();        

       OTPCode::create([
           'user_id' => $data->id,
           'kode_otp' => rand(100000, 999999)
       ]);

       return response('Thanks you are Registered');
    }
};
