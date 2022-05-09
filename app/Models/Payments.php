<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payments extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'order_id',
        'user_id',
        'amount_paid',
        'reference',
        'paymentMethod',
        'proofOfPaymentPath',
        'approved',
        'approved_by'
    ];

    protected $casts = [
        'approved' => 'boolean',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
