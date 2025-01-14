<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    /** @use HasFactory<\Database\Factories\MatchesFactory> */
    use HasFactory;

    protected $fillable = [
        'pet1_id',
        'pet2_id',
        'status',
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
