<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'body', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }

    public static function getPosts() {
        $user_id = Auth::user()->id;

        if(Auth::user()->role != 'admin') {
            $data['posts'] = Post::where('user_id', $user_id)->orderBy('id','desc')->paginate(9);
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
            $posts = Post::where('title', 'LIKE', '%'.$search.'%')->get();
            $data = view('elements.post-paragraph', ['posts' => $posts])->render();
            return response()->json([
                'error' => false,
                'html' => $data,
            ]);
        }
    }
}
