<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Featuer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];
    public function upvotes():hasMany
    {
        return $this->hasMany(Upvote::class);
    }

    public function commits ():hasMany
    {
        return $this->hasMany(Commit::class);
    }

    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }


}
