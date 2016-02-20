<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $fillable = ['title', 'game_id'];

    public function games()
    {
        return $this->hasMany('App\Games');
    }
}
