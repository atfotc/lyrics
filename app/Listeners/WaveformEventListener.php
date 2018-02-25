<?php

namespace App\Listeners;

use App\Events\WaveformEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;

class WaveformEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(WaveformEvent $event)
    {
        $track = $event->song->track;
        $trackName = explode(".", explode("/", $track)[1])[0];
        
        $trackPath = Storage::path($track);
        $waveformPath = Storage::path("waveforms/{$trackName}.png");

        // $command = "ffmpeg -i /path/to/input -filter_complex 'compand,showwavespic=s=2048x480:colors=#00000099' -frames:v 1 /path/to/output 2>&1";
        $command = "ffmpeg -i {$trackPath} -filter_complex 'showwavespic=s=2048x480:colors=#00000099' -frames:v 1 {$waveformPath} 2>&1";

        exec($command, $output);

        // Log::info($command);
        // Log::info($output);

        $event->song->waveform = "waveforms/{$trackName}.png";
        $event->song->save();
    }
}
