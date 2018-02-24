<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'from',
        'to',
        'verse_id',
        'video_id',
    ];

    public function verse()
    {
        return $this->belongsTo(Verse::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }
}
