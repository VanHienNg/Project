<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Response;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['posts'] = Post::orderBy('id','desc')->paginate(9);

        return view('/post', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Post::where($where)->first();
 
        return Response::json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->delete();

        return Response::json($post);
    }

    /*Live search */
    public function search(Request $request)
    {
        if($request->ajax()) {
            $search = $request->get('search');
            $posts = Post::where('title', 'LIKE', '%'.$search.'%')->get();
            $data = view('post-paragraph', ['posts' => $posts])->render();
            return response()->json([
                'error' => false,
                'html' => $data,
            ]);
        }
    }
}
