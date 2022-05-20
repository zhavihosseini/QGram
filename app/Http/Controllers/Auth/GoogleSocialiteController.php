<?php

namespace App\Http\Controllers\Auth;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
class GoogleSocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }else{
                $findemail = User::where('email',$user->email)->first();
                    $str = Str::random('5');
                    $name = $user['given_name'];
                    $family = $user['family_name'];
                if (!$findemail) {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'username' => $name . $family . $str,
                        'password' => Hash::make('XCXVireferGgeoirhge54674Gwerfg'),
                    ]);
                    $userz = $newUser->toArray();
                    $emails = $userz['email'];
                    Auth::login($newUser);
                    Mail::to($emails)->send(new WelcomeMail($userz));
                    if ($newUser == ""){
                        return route('login');
                    }
                }
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
