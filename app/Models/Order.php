<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'user_id',
        'dish_id',
        'quantity',
    ];
    
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'order_dish')->withPivot('quantity');
    }

}
