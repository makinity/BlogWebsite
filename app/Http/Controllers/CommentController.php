<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request, $id, $userId){
        $post = Post::findOrFail($id);

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        
        $post->comments()->create([
            'post_id' => $post->id,
            'user_id' => $userId,
            'comment' => $request->comment
        ]);

        return redirect()->route('show.post', $id)->with('success', 'Your Comment on this Blog Post has been submitted...');
    }
}
