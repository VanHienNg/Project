<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        } else {
            $user = Auth::user()->role;
            if($user == "admin") {
                return redirect() -> to('/admin');
            } else {
                return redirect() -> to('/post');
            }
        }
    }

    public function destroy() {
        
        auth() -> logout();

        return redirect() -> to('/index');
    }
}
