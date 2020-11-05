<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
       User::create([
        'name' => request('name'),
        'email' => request('email'),
        'password' => bcrypt(request('password'))
       ]);

       return response('Thanks you are Registered');
    }
};
