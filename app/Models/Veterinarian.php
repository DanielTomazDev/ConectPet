<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinarian extends Model
{
    /** @use HasFactory<\Database\Factories\VeterinarianFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
