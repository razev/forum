<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function like($id)
    {
        Like::create([
            'reply_id'=>$id,
            'user_id'=>Auth::id()
        ]);

        Session::flash('success','You Liked the reply');

        return redirect()->back();
    }

    public function unlike($id)
    {
        $like=Like::where('reply_id',$id)->where('user_id',Auth::id())->first();
        $like->delete();

        Session::flash('success','You have unliked the reply');

        return redirect()->back();

    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);
        $reply->best_answer = 1;
        $reply->save();

        Session::flash('success','You hav marked the best answer for your reply');
        return redirect()->back();

    }
}
