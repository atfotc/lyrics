<?php

namespace App\Events;

use App\Song;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProbeEvent
{
    use SerializesModels;

    public $song;

    public function __construct(Song $song)
    {
        $this->song = $song;
    }
}
