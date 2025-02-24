<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'price',
        'quota',
        'description',
    ];
    public function event() {
        return $this->hasMany(Event::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
