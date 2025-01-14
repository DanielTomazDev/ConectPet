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

    public function matches()
    {
        return $this->hasMany(Matches::class, 'pet1_id')->orWhere('pet2_id', $this->id);
    }
}