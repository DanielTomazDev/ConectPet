<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetLike extends Model
{
    protected $fillable = [
        'user_id',
        'pet_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}
