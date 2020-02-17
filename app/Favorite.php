<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'price',
        'sale'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Favorites');
    }
}
