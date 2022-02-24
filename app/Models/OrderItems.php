<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
    ];

    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
