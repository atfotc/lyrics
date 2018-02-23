<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verse extends Model
{
    protected $fillable = [
        'words',
        'song_id',
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
