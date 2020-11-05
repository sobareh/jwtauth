<?php


Route::namespace('Auth')->group(function() {
  Route::post('register', 'RegisterController');
  Route::post('login', 'LoginController');
  Route::post('logout', 'LogoutController');
  
});

Route::get('user', 'UserController');