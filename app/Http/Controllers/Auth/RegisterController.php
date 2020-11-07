<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\OTPCode;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
       $data = new User;
       $data->name = request('name');
       $data->email = request('email');
       $data->save();
       
       $time = new Carbon;
       $datatime = $time->now()->addMinutes(15);

       OTPCode::create([
           'user_id' => $data->id,
           'otp' => rand(100000, 999999),
           'valid_until' => $datatime
       ]);

       return new RegisterResource($data);
    }
};
