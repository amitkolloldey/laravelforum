<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider){

        return Socialite::driver($provider)->redirect();
    }


    public function handleProviderCallback($provider){

        $socialUser = Socialite::driver($provider)->user();

        $findUser = User::where('email',$socialUser->email)->first();
            if($findUser){
                Auth::login($findUser);
                return redirect('/');
            }else{
                $user = new User();
                $user->name = $socialUser->name;
                $user->email = $socialUser->email;
                $user->confirmed = 1;
                $user->provider = $provider;
                $user->provider_id = $socialUser->id;
                $user->save();
                Auth::login($user);
                return redirect('/');
            }
        }
    }
