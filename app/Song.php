<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'name',
        'track',
        'duration',
        'creators',
        'performers',
        'year',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verses()
    {
        return $this->hasMany(Verse::class);
    }
}
