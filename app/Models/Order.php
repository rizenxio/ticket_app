<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDO;

class Order extends Model
{
    protected $fillable =[
        'user_id',
        'order_code',
        'total_amount',
        'status',
        'payment_method',
        'midtrans_transaction_id',
        'midtrans_transaction_status',
        'payment_deadline',
    ];

    protected $casts = [
        'payment_deadline' => 'datetime',
    ];

    public function user(){
        return $this->BelongsTo(User::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
    public function tickets(){
        return $this->hasManyThrough(Ticket::class, OrderDetail::class);
    }
}
