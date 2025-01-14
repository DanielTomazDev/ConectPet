<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetShop extends Model
{
    /** @use HasFactory<\Database\Factories\PetShopFactory> */
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
