<?php

namespace App\Listeners;

use App\Events\ProbeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class ProbeEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProbeEvent $event)
    {
        $track = $event->song->track;
        $path = public_path("storage/{$track}");
        $command = "ffmpeg -i {$path} -f null - 2>&1";

        exec($command, $output);

        // Log::info($command);
        // Log::info($output);

        $line = array_slice($output, -2, 1)[0];
        preg_match("/time=\d+:(\d+:\d+).\d+/", $line, $matches);

        // Log::info($matches);
        
        $event->song->duration = $matches[1];
        $event->song->save();
    }
}
