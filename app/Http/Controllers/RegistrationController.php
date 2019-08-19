<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use App\User;

class RegistrationController extends Controller
{
    public function create() {
        return view('register');
    }

    public function store(RegistrationRequest $request) {
        $input = $request -> all();
        $user = User::create($input);

        auth() -> login($user);

        return redirect() -> to('/index');
    }
    
}
