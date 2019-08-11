<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create() {
        return view('/login');
    }

    public function store() {
        if(auth() -> attempt(request(['name', 'password'])) == false) {
            return back() -> withErrors([
                'message' => 'Password or Username is incorrect' 
            ]);
        }

        return redirect() -> to('/index');
    }

    // public function destroy() {
    //     auth() -> logout();

    //     return redirect() -> to('/index');
    // }
}
