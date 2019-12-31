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
        'user_id'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User');
    }
}
