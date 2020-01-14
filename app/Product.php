<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('quantity');
    }
}
