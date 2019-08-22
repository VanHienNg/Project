<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Redirect, Response;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'role', 'email', 'password'
    ];

    protected $table = 'users';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    *Add a mutator to ensure hashed passwords (need to protect password):
    */
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function post()
    {
        return $this->hasMany('App\Post', 'user_id', 'id');
    }

    public function feedback()
    {
        return $this->hasMany('App\FeedBack', 'user_id', 'id');
    }
    /**
     * Checks if User has access to $permissions.
     */
    
    public static function getUsers() {
        $data['users'] = User::orderBy('id','desc')->paginate(8);

        return $data;
    }

    public static function storeUsers($request) {
        $userId = $request->user_id;
        $user = User::updateOrCreate(['id' => $userId],
                        [
                            'name' => $request->name, 
                            'email' => $request->email,
                            'role' => $request->role,
                            'password' => $request->password
                        ]
                    );
        return $user;
    }

    public static function showPostsUser($request) {
        if($request -> ajax()) {
            $user_id = $request->get('id');
            $post = User::findOrFail($user_id)->post()->get();
            $data = view('elements.post-paragraph', ['posts' => $post]) -> render();
            return response()->json([
                'html' => $data,
            ]);
        }
    }

    public static function editUsers($id) {
        $where = array('id' => $id);
        $user  = User::where($where) -> first();
 
        return Response::json($user);
    }

    public static function deleteUsers($id) {
        $user = User::where('id',$id) -> delete();
    
        return Response::json($user);
    }

    public static function searchUsers($request) {
        if($request -> ajax()) {
            $search = $request -> get('search');
            $users = User::where('name', 'LIKE', '%'.$search.'%') -> get();
            $data = view('elements.user-row', ['users' => $users]) -> render();
            return response() -> json([
                'html' => $data,
            ]);
        }
    }

    public static function checkLogin($request) {
        $user = $request->only('name', 'password');
        if(auth() -> attempt($user) == false) {
            return back() -> withErrors([
                'message' => 'Password or Username is incorrect' 
            ]);
        } else {
            return redirect() -> to('/index');
        }
    }

    public static function checkLogout() {
        auth() -> logout();

        return redirect() -> to('/index');
    }

    public static function registrationUser($request) {
        $input = $request -> all();
        $user = User::create($input);

        auth() -> login($user);

        return redirect() -> to('/index');
    }
}
