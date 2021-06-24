<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    public function callback($provider)
    {
            
        $getInfo = Socialite::driver($provider)->user();
        
        $user = $this->createUser($getInfo,$provider);
    
        auth()->login($user);
    
        return redirect()->to('/');
    
    }
    function createUser($getInfo,$provider){
 
        $user = User::where('provider_id', $getInfo->id)->first();
        $check = User::where('email', $getInfo->email)->first();
        if(!$check)
        {
            if (!$user) {
                $user = User::create([
                    'name'     => $getInfo->name,
                    'email'    => $getInfo->email,
                    'provider' => $provider,
                    'provider_id' => $getInfo->id,
                    'level'     => 0,
                    'avatar' => $getInfo->avatar
                ]);
            }
        }
        else
        {
            if (!$user) {
                $check->provider = $provider;
                $check->provider_id = $getInfo->id;
                $check->avatar = $getInfo->avatar;
                $check->save();
                return $check;
            }
            else
            {
                $check->avatar = $getInfo->avatar;
                $check->save();
                return $check;
            }
        }
        return $user;
    }
}