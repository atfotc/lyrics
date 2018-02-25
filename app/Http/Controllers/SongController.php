<?php

namespace App\Http\Controllers;

use App\Events\ProbeEvent;
use App\Events\WaveformEvent;
use App\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SongController extends Controller
{
    public function index()
    {
        return view('songs.index', [
            'songs' => auth()->user()->songs,
        ]);
    }

    public function create()
    {
        return view('songs.create');
    }

    public function store(Request $request)
    {
        $path = $request->file('track')->store('tracks');

        $song = Song::create([
            'name' => $request->input('name'),
            'track' => $path,
            'creators' => $request->input('creators'),
            'performers' => $request->input('performers'),
            'year' => $request->input('year'),
            'user_id' => auth()->user()->id,
        ]);

        event(new ProbeEvent($song));
        event(new WaveformEvent($song));

        return redirect()->route('songs.index');
    }

    public function edit(Song $song)
    {
        return view('songs.edit', [
            'song' => $song,
        ]);
    }

    public function update(Request $request, Song $song)
    {
        if ($request->hasFile('track')) {
            if (Storage::exists($song->track)) {
                Storage::delete($song->track);
            }

            if (Storage::exists($song->waveform)) {
                Storage::delete($song->waveform);
            }

            $song->track = $request->file('track')->store('tracks');
        }

        $song->name = $request->input('name');
        $song->creators = $request->input('creators');
        $song->performers = $request->input('performers');
        $song->year = $request->input('year');
        $song->save();

        event(new ProbeEvent($song));
        event(new WaveformEvent($song));

        return redirect()->route('songs.index');
    }

    public function destroy(Song $song)
    {
        foreach ($song->verses as $verse) {
            $verse->delete();
        }

        if (Storage::exists($song->track)) {
            Storage::delete($song->track);
        }

        if (Storage::exists($song->waveform)) {
            Storage::delete($song->waveform);
        }

        $song->delete();

        return redirect()->route('songs.index');
    }

    public function stream(Song $song)
    {
        return new BinaryFileResponse(Storage::path($song->track));
    }
}
