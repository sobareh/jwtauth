<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, User $user)
    {
      $request->validate([
          'email' => 'required',
          'password' => 'required'
      ]);

      if (!$token = auth()->attempt($request->only('email', 'password'))) {
        return response(null, 401);
      }

      $data = $user->find(Auth::user()->id);

      return response()->json(compact(['token', 'data']));
    }
}
