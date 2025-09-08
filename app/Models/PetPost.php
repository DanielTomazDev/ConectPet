<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PetPost extends Model
{
    protected $fillable = [
        'pet_id',
        'title',
        'description',
        'photo',
        'likes_count',
    ];

    /**
     * Get the pet that owns the post.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the photo URL.
     */
    public function getPhotoUrlAttribute(): string
    {
        return \Storage::url($this->photo);
    }

    /**
     * Get the likes for the post.
     */
    public function likes()
    {
        return $this->hasMany(PostLike::class, 'post_id');
    }

    /**
     * Get the comments for the post.
     */
    public function comments()
    {
        return $this->hasMany(PostComment::class, 'post_id');
    }
}
