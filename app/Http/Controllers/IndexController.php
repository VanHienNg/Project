<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class IndexController extends Controller
{
    public function index() 
    {
        $data['posts'] = Post::orderBy('id', 'desc') -> paginate(9);

        return view('/index', $data);
    }

    public function search(Request $request) 
    {
        if($request -> ajax()) {
            $search = $request -> get('search');
            $posts = Post::where('title', 'LIKE', '%'.$search.'%') -> get();
            $data = view('elements.post-paragraph', ['posts' => $posts]) -> render();
            return response() -> json([
                'html' => $data,
            ]);
        };
    }
}
