<?php

namespace App\Http\Controllers;

use App\Models\PostLike;
use App\Models\PetPost;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    /**
     * Toggle like for a post.
     */
    public function toggle(Request $request, $postId)
    {
        $post = PetPost::findOrFail($postId);
        $user = auth()->user();
        
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
        
        $existingLike = PostLike::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            PostLike::create([
                'post_id' => $postId,
                'user_id' => $user->id,
            ]);
            $liked = true;
        }
        
        $likesCount = PostLike::where('post_id', $postId)->count();
        $post->update(['likes_count' => $likesCount]);
        
        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount
        ]);
    }
}
