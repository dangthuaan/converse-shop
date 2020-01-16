<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'total_price',
        'quantity',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }

    /**
     * Scope a query get new order.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNewOrder($query)
    {
        return $query->where('status', 1);
    }
}
