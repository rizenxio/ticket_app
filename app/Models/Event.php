<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable =[
        'title',
        'description',
        'venue',
        'event_date',
        'event_time',
        'total_seats',
        'available_seats',
        'price',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime'
    ];

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
