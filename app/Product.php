<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image',
        'name',
        'gender',
        'category',
        'description',
        'publish_date',
        'price',
        'sale',
        'user_id',
    ];

    protected $appends = [
        'first_image',
    ];

    public function getFirstImageAttribute()
    {
        $images = explode('|', $this->image);

        return isset($images[0]) ? $images[0] : null;
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment')->whereNull('parent_id');
    }
}
