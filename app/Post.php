<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Redirect, Response;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function feedback()
    {
        return $this->hasMany('App\FeedBack', 'post_id', 'id');
    }

    public static function getPosts($index) {

        if(Auth::check()) {
            if($index != 0) {
                $user_id = Auth::user()->id;
                $data['posts'] = Post::where('user_id', $user_id)->orderBy('id','desc')->paginate(9);
            } else {
                $data['posts'] = Post::orderBy('id','desc')->paginate(9);
            }
        } else {
            $data['posts'] = Post::orderBy('id','desc')->paginate(9);
        }

        return $data;
    }

    public static function storePosts($request) {
        $postId = $request->post_id;
        $post = Post::updateOrCreate(
                    ['id' => $postId],
                    [
                        'title' => $request->title,
                        'slug' => $request->slug,
                        'body' => $request->body,
                        'user_id' => $request->user_id
                    ]
                );
        return Response::json($post);
    }

    public static function deletePosts($id) {
        $post = Post::where('id', $id)->delete();

        return Response::json($post);
    }

    public static function searchPosts($request) {
        if($request->ajax()) {
            $search = $request->get('search');
            $user_id = $request->get('user_id');
            $posts = Post::where([
                                    ['title', 'LIKE', '%'.$search.'%'],
                                    ['user_id', 'LIKE', '%'.$user_id.'%'],
                                ])->get();
            $data = view('elements.post-paragraph', ['posts' => $posts])->render();
            return response()->json([
                'html' => $data,
            ]);
        }
    }
}
