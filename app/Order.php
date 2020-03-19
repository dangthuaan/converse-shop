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

    public function user()
    {
        return $this->belongsTo('App\User');
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

    /**
     * Scope a boolean of in progress orders.
     *
     * @return Boolean
     */
    public function scopeIsInProgressOrder()
    {
        return $this->status == 1;
    }

    /**
     * Scope a boolean of delivered orders.
     *
     * @return Boolean
     */
    public function scopeIsDeliveredOrder()
    {
        return $this->status == 2;
    }

    /**
     * Scope a boolean of closed orders.
     *
     * @return Boolean
     */
    public function scopeIsClosedOrder()
    {
        return $this->status == 3;
    }
}
