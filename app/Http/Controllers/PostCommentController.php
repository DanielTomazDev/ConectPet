<?php

namespace App\Http\Controllers;

use App\Models\PostComment;
use App\Models\PetPost;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    /**
     * Store a new comment for a post.
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        
        $post = PetPost::findOrFail($postId);
        
        $comment = PostComment::create([
            'post_id' => $postId,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        
        $comment->load('user');
        
        return response()->json([
            'success' => true,
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'user_name' => $comment->user->name,
                'created_at' => $comment->created_at->diffForHumans(),
            ]
        ]);
    }
}
