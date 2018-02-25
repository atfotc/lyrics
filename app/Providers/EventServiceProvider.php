<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\ProbeEvent' => [
            'App\Listeners\ProbeEventListener',
        ],
        'App\Events\WaveformEvent' => [
            'App\Listeners\WaveformEventListener',
        ],
    ];
}
