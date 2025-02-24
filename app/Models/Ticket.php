<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable =[
        'order_detail_id',
        'ticket_code',
        'status',
        'check_in_time',
    ];

    protected $casts = [
        'check_in_time' => 'datetime'
    ];

    public function orderDetail(){
        return $this->belongsTo(orderDetail::class);
    }

    public function order(){
        return $this->hasOneThrough(Order::class, OrderDetail::class);
    }
}
