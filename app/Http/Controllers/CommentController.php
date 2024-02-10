<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function comment(Request $request, $postId)
    {
        $request->validate([
            "text" => "required",
        ]);

        $comment = Comment::create([
            "post_id" => $postId,
            "user_id" => auth()->user()->id,
            "text" => $request->text,
        ]);
        return back();
    }

    public function edit($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Gate::denies('edit-comment', $comment)) {
            return back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view("comment.edit", compact("comment"));

        // if ($comment->user_id !== Auth::user()->id) {
        //     return back()->with('error', 'You are not authorized to edit this comment.');
        // }
    }

    public function update(Request $request, $commentId)
    {
        $request->validate([
            "text" => "required",
        ]);

        $comment = Comment::findOrFail($commentId);
        Gate::authorize('update-comment', $comment);

        // if ($comment->user_id !== Auth::user()->id) {
        //     return back()->with('error', 'You are not authorized to update this comment.');
        // }

        $comment->update([
            "text" => $request->text,
        ]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully');
    }
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if (Gate::denies('delete-comment', $comment)) {
            return back()->with('error', 'You are not authorized to delete this comment.');
        }

        $comment->delete();
        return back()->with('success', 'Comment deleted successfully');

        // $comment = Comment::findOrFail($commentId);
        // $postOwner = $comment->post->user;

        // if (Auth::user()->id !== $comment->user_id && Auth::user()->id !== $postOwner->id) {
        //     return back()->with('error', 'You are not authorized to delete this comment.');
        // }

        // $comment->delete();
    }

}
