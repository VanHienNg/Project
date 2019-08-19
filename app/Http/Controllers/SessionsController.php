<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;

class SessionsController extends Controller
{
    public function create() {
        return view('/login');
    }

    public function store(SessionRequest $request) {
        $user = $request->only('name', 'password');
        if(auth() -> attempt($user) == false) {
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
