<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'parent_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function replies()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Comment', 'parent_id');
    }
}
