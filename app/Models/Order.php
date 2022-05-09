<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\OrderItems;
use App\Models\OrderComments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_reference',
        'total',
        'shippingAddress',
        'status',
        'shippingNote',
        'discountCode',
        'distributorCode',
    ];

    protected $casts = [
        'total' => 'double:2',
    ];

    public static $shippingFee = 100;

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function comments(){
        return $this->hasMany(OrderComments::class);
    }

    public function payment(){
        return $this->hasOne(Payments::class);
    }

    public function isPaid(){
        if($this->payment){
            return $this->payment->amount_paid > 0 ? true : false;
        }

        return false;
    } 

    // public function getStatusAttribute($attribute)
    // {
    //     return ucfirst($attribute);
    // }
    public static $orderStatuses = [
        'awaiting payment' => "Awaiting payment from customer",
        'payment received' => "Payment received from customer",
        'shipped' =>  "Order shipped to customer",
        'delivered' =>  "Order delivered to customer",
        'cancelled' =>  "Order cancelled",
    ];
}
