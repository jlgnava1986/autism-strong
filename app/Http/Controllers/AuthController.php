<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Socialite;

class AuthController extends Controller
{
    public function redirectToFacebook() {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback() {
        $data = Socialite::with('facebook')->user();
        $user = User::where('email', $data ->email)->first();

        if(!is_null($user)) {
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        } else {
            $user = User::where('facebook_id', $data->id)->first();
            if(is_null($user)) {
                $user = new User();
                $user->name = $data->user['name'];
                $user->email = $data->email;
                $user->facebook_id = $data->id;
                $user->save();
            }
            
            Auth::login($user);
        }

        return redirect('/')->with('success', 'Successfully logged in!');
    }
}
