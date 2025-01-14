<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adoptionRequest extends Model
{
    /** @use HasFactory<\Database\Factories\AdoptionRequestFactory> */
    use HasFactory;

    protected $fillable = [
        'adoption_pet_id',
        'user_id',
        'message',
    ];

    public function adoptionPet()
    {
        return $this->belongsTo(adoptionPets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
