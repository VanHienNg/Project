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
        return User::registrationUser($request);
    }
    
}
