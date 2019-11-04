<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    public function favorite_users()
    {

        //return $this->hasMany(User::class);

        //return $this->belongsTo(User::class);
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id');

        //return $this->belongsToMany(User::class, 'favorites');

        //return $this->belongsTo(User::class);
    }






}