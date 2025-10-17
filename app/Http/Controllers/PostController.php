<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function homepage(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(8);

        return view('blog.index', ['posts' => $posts]);
    }

    public function showPost($id){
        $post = Post::with('user')->findOrFail($id);
        $likesCount = $post->likes()->count();

        $comments = Comment::with('user')->where('post_id', $post->id)->get();

        return view('blog.show', ['post' => $post, 'likesCount' => $likesCount, 'comments' => $comments]);
    }

    public function showCreatePost($id){
        $user = User::findOrfail($id);
        return view('blog.create', ['user' => $user]);
    }

    public function createPost(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = $id;

        if ($post->save()) {
            return redirect()->route('show.home')->with('success', 'Post created successfully!');
        }

        return back()->withErrors(['error' => 'Post not saved.']);
    }

    public function manage($id){
        $posts = Post::with('user')->where('user_id', $id)->orderBy('created_at', 'desc')->get();
        return view('blog.manage',['posts' => $posts]);
    }

    public function editPost($id){
        $posts = Post::findOrFail($id);
        return view('blog.edit',['posts' => $posts]);
    }

    public function edit(Request $request, $id){
        $posts = Post::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:20'
        ]);

        $posts->update($validated);

        return redirect()->route('show.manage', $posts->user_id)->with('success', 'Post Updated...');
    }

    public function delete(Post $post){
        $post->delete();
        return redirect()->route('show.home', $post)->with('success', 'Post Deleted...');
    }
}
