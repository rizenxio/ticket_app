<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable =[
        'order_id',
        'event_id',
        'ticket_category_id',
        'quantity',
        'price_per_ticket',
        'subtotal',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function event(){
        return $this->belongsTo(Event::class);

    }

    public function ticketCategory(){
        return $this->belongsTo(TicketCategory::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
