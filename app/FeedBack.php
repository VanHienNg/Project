<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Redirect, Response;

class FeedBack extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'feedback'
    ];

    public static function saveFeedback($request) {
        $feedback = new FeedBack;
        $feedback->user_id = Auth::user()->id;
        $feedback->post_id = $request->get('post_id');
        $feedback->feedback = $request->get('feedback');
        $feedback->save();

        return response()->json($feedback);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
