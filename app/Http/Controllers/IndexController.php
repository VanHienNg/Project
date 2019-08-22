<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\FeedBack;
use App\Post;

class IndexController extends Controller
{
    public function index() 
    {
        $data = Post::getPosts(0);
         
        return view('/index', $data);
    }

    public function search(Request $request) 
    {
        return Post::searchPosts($request);
    }

    public function store(Request $request)
    {
        return FeedBack::saveFeedback($request);
    }
}
