<?php

Route::namespace('Auth')->group(function() {
  Route::post('register', 'RegisterController');
  Route::post('login', 'LoginController');
  Route::post('logout', 'LogoutController');
  Route::post('verification', 'VerifyOTPController');
  Route::post('regenerate-otp', 'RegenerateOTPController');
  Route::post('update-password', 'UpdatePasswordController');
});

Route::get('user', 'UserController');
Route::post('update-profile', 'UpdateProfileUser');