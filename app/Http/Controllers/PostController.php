<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        // $userId = Auth::user()->id;
        // $posts = Post::where('user_id', $userId)->latest()->get();
        // $post = new Post;
        // return view("welcome", compact('posts', 'post'));
    }

    public function create()
    {
        return view("post.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        Post::create($data);

        return redirect()->route('index')->with('success', 'You have successfully created!');
    }

    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginForm');
        }

        $comments = Comment::where("post_id", $id)->get();
        $post = Post::findOrfail($id);

        return view("post.detail", compact('post', 'comments'));
    }

    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        // Gate::authorize('edit-post', $post);
        if (Gate::denies('edit-post', $post)) {
            return back()->with('error', 'You are not authorized to edit this post.');
        }

        if (!Auth::check()) {
            return redirect()->route('loginForm');
        }

        $posts = Post::all();

        // if ($post->user_id !== Auth::user()->id) {
        //     return redirect()->route('index')->with('error', 'You are not authorized to edit this post.');
        // }

        return view("welcome", compact('post', 'posts'));
    }

    public function update(Request $request, string $id)
    {
        $post = Post::findOrfail($id);
        Gate::authorize('update-post', $post);

        $data = $this->validateRequest($request);

        $post->update($data);
        return redirect()->route('index')->with('success', 'You have successfully updated!');
    }

    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('loginForm');
        }

        $post = Post::findOrFail($id);
        if (Gate::denies('delete-post', $post)) {
            return back()->with('error', 'You are not authorized to delete this post.');
        }

        // if ($post->user_id !== Auth::user()->id) {
        //     return redirect()->route('index')->with('error', 'You are not authorized to delete this post.');
        // }

        Post::destroy($id);
        return back()->with('success', 'You have successfully deleted!');
    }

    private function validateRequest(Request $request)
    {
        return $request->validate([
            "user_id" => "required",
            "title" => "required",
            "body" => "required",
        ]);
    }
}
