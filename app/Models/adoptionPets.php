<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adoptionPets extends Model
{
    /** @use HasFactory<\Database\Factories\AdoptionPetsFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pet_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function requests()
    {
        return $this->hasMany(AdoptionRequest::class);
    }
}
