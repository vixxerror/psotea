<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\posts;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required:max:250',
        ]);
        $comment = new Comment();
        $comment->user_id = $request->user()->id;
        $comment->content = $request->get('content');
        $post = Post::find($request->get('post_id'));

        $user = User::find($post->user->id);
        $user->notify(new posts($post,$comment));

        $post->comments()->save($comment);

        return redirect()->route('post',['id' => $request->get('post_id')]);
    }

    public function noti(Request $request)
    {
        $user=$request->user();
        $noti = $user->unreadNotifications;
        return view('/noti',compact('noti'));
    }
   
}
