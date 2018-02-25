<?php

namespace App\Listeners;

use App\Events\ProbeEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;

class ProbeEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(ProbeEvent $event)
    {
        $track = $event->song->track;
        
        $path = Storage::path($track);
        $command = "ffprobe {$path} 2>&1";

        exec($command, $output);

        // Log::info($command);
        // Log::info($output);

        $lines = join("\n", $output);
        preg_match("/Duration: \d+:(\d+:\d+).\d+/", $lines, $matches);

        // Log::info($matches);
        
        $event->song->type = Storage::mimeType($track);
        $event->song->size = Storage::size($track);
        $event->song->duration = $matches[1];
        $event->song->save();
    }
}
