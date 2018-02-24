<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'name',
        'width',
        'height',
        'padding',
        'fade',
        'user_id',
        'song_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
}
