<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetMatch extends Model
{
    protected $fillable = [
        'pet1_id',
        'pet2_id',
        'is_active',
    ];

    public function pet1()
    {
        return $this->belongsTo(Pet::class, 'pet1_id');
    }

    public function pet2()
    {
        return $this->belongsTo(Pet::class, 'pet2_id');
    }
}
