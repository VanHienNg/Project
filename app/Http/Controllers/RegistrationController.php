<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create() {
        return view('register');
    }


    public function store() {
        $this->validate(request(), [ 
            'name' => 'bail|required',
            'email' => "bail|required|email",
            'password' => "bail|required",
            'password-comfirmation' => 'bail|same:password'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        auth() -> login($user);

        return redirect() -> to('/index');
    }
    
}
