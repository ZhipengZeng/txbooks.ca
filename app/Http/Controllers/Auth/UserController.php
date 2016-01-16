<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Hash;
use App\User;
use Mail;
use Input;

class UserController extends Controller
{
    public function getRegister(){
        return view('auth.register');
    }
    public function postRegister(Request $request){
//        dd($request->all());
        $validator = Validator::make($request->all(), [
        	'username' => 'required|unique:users|alpha_dash|between:4,12',
            'email' => 'required|unique:users|email',
            'password' => 'required|alpha_dash|between:8,16|confirmed',
            'password_confirmation' => 'required|alpha_dash|between:8,16'
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $user = new User;
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->confirmation_code = str_random(30);

            Mail::send('emails.verify', array('confirmation_code'=>$user->confirmation_code), function($message) {
            	$message->from('keviniszzp@gmail.com', 'Laravel-zzp');
	            $message->to(Input::get('email'), Input::get('username'))
	                ->subject('Verify your email address');
	        });


            $user->save();
            notify()->flash('Please confirm your registration in your mailbox','success');
            return back();
        }
    }

    public function logout(){
    	if(Auth::check()){
    		Auth::logout();
    		notify()->flash('You have logged out.','success');
    		return redirect()->route('home');
    	}else{
    		notify()->flash('You have not logged in.','warning');
    		return redirect()->route('home');
    	}
    }

    public function verify($confirmation_code){

    	$user = User::where('confirmation_code', $confirmation_code)->first();

    	if ( ! $user)
        {
            notify()->flash('Wrong confirmation code.','error');

        }else{
        	$user->confirmed = 1;
	        $user->confirmation_code = null;
	        Auth::login($user);
	        notify()->flash('Registration completed.','success');
	        $user->save();
        }
        return redirect()->route('home');
    }
}
