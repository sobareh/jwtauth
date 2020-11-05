<?php


Route::namespace('Auth')->group(function() {
  Route::post('register', 'RegisterController');
  Route::post('login', 'LoginController');
  
});

Route::get('user', 'UserController');