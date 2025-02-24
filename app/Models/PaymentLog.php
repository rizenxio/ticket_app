<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $fillable = [
        'order_id',
        'midtrans_transaction_id',
        'payment_type',
        'gross_amount',
        'transaction_status',
        'transaction_time',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'transaction_time' => 'datetime'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
