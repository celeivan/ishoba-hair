<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'order_reference',
        'total',
        'shippingAddress',
        'shippingNote',
        'discountCode',
        'distributorCode',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function getStatusAttribute($attribute)
    {
        return ucfirst($attribute);
    }
}
