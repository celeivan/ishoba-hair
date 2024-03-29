<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'description',
        'imageUrl',
    ];


    protected $casts = [
        'price' => 'double:2',
    ];

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }
}
