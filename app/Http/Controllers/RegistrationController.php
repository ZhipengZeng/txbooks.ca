<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
    public function store()
    {
        $rules = [
            'username' => 'required|min:6|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:8,16|confirmed'
        ];

        $input = Input::only(
            'username',
            'email',
            'password',
            'password_confirmation'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        $confirmation_code = str_random(30);

        User::create([
            'username' => Input::get('username'),
            'email' => Input::get('email'),
            'password' => Hash::make(Input::get('password')),
            'confirmation_code' => $confirmation_code
        ]);

        Mail::send('emails.verify', $confirmation_code, function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });

        Flash::message('Thanks for signing up! Please check your email.');

        return Redirect::home();
    }

    public function confirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user = User::whereConfirmationCode($confirmation_code)->first();

        if ( ! $user)
        {
            throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        Flash::message('You have successfully verified your account.');

        return Redirect::route('login_path');
    }

}
