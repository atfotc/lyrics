<?php

namespace App\Events;

use App\Song;
use Illuminate\Queue\SerializesModels;

class ProbeEvent
{
    use SerializesModels;

    public $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }
}
