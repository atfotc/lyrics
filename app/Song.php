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

    public function getSecondsAttribute()
    {
        if (!isset($this->attributes["duration"])) {
            return null;
        }

        $parts = explode(":", $this->attributes["duration"]);
        
        return ((int) $parts[0] * 60) + (int) $parts[1];
    }
}
