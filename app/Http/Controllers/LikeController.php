<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($id){
        $post = Post::find($id);

        if ($post->likes()->where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('info', 'You already liked this post.');
        }

        $post->likes()->create([
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('show.post', $post);
    }
}
