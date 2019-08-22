<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{
    public function create() {
        return view('/login');
    }

    public function store(SessionRequest $request) {
        return User::checkLogin($request);
    }

    public function destroy() {
        return User::checkLogout();
    }
}
