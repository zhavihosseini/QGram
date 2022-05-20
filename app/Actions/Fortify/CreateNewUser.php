<?php

namespace App\Actions\Fortify;

use App\Events\UserCreated;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255','alpha_dash','min:7'],
            'username' => ['required', 'string', 'max:255','unique:users', 'alpha_dash','regex:/^[\pL\s\-]+$/u','without_spaces'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'g-recaptcha-response' => ['required','captcha'],
            'Confirms' => ['required'],
            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'Confirms'=>$input['Confirms'],
            'g-recaptcha-response' => ['captcha'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
