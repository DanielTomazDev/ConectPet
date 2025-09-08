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
        try {
            \Log::info('PostLikeController::toggle called', ['postId' => $postId, 'user' => auth()->id()]);
            
            $post = PetPost::findOrFail($postId);
            $user = auth()->user();
            
            if (!$user) {
                \Log::error('User not authenticated');
                return response()->json(['error' => 'User not authenticated'], 401);
            }
            
            $existingLike = PostLike::where('post_id', $postId)
                ->where('user_id', $user->id)
                ->first();
            
            if ($existingLike) {
                // Remove like
                $existingLike->delete();
                $liked = false;
                \Log::info('Like removed');
            } else {
                // Add like
                PostLike::create([
                    'post_id' => $postId,
                    'user_id' => $user->id,
                ]);
                $liked = true;
                \Log::info('Like added');
            }
            
            // Update likes count
            $likesCount = PostLike::where('post_id', $postId)->count();
            $post->update(['likes_count' => $likesCount]);
            
            \Log::info('Response data', ['liked' => $liked, 'likes_count' => $likesCount]);
            
            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in PostLikeController::toggle', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
