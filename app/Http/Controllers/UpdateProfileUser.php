<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UpdateProfileResource;

class UpdateProfileUser extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth:api');
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => ['string', 'required'],
            'photo' => ['mimes:jpeg,jpg,png,bmp', 'max:512']
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        
        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
                \Storage::delete('public/' . $user->photo);
            }

            $file = $request->file('photo');
            
            $name = auth()->user()->id . '.' . $file->getClientOriginalExtension();
            $destination_path = public_path('photos/users/profile-photo/');
            $file->move($destination_path, $name);
            $filepath = "/photos/users/profile-photo/" . $name;
            $user->photo = $filepath;
        }
        
        $user->save();
        
        return new UpdateProfileResource($user);
    }
}
