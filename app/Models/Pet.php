<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    /** @use HasFactory<\Database\Factories\PetFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'breed',
        'type',
        'gender',
        'profile_picture',
        'bio',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matches()
    {
        return $this->hasMany(PetMatch::class, 'pet1_id')->orWhere('pet2_id', $this->id);
    }

    public function likes()
    {
        return $this->hasMany(PetLike::class);
    }

    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'pet_likes');
    }

    public function comments()
    {
        return $this->hasMany(PetComment::class);
    }

    public function posts()
    {
        return $this->hasMany(PetPost::class)->latest();
    }
}