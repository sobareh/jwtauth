<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\GetProfileResource;

class UserController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        $dataprofile = auth()->user();

        return new GetProfileResource($dataprofile);
    }
}
