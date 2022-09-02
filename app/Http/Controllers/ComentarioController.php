<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //Validate
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        // save the comment
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id'=> $post->id,
            'comentario' => $request->comentario,
        ]);

        //Printin the message
        return back()->with('mensaje', 'Your comment has been sent successfully');
    }
}
