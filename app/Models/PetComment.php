<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetComment extends Model
{
    protected $fillable = [
        'pet_id',
        'user_id',
        'comment',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
