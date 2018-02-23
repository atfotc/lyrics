<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

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

        Song::create([
            'name' => $request->input('name'),
            'track' => $path,
            'creators' => $request->input('creators'),
            'performers' => $request->input('performers'),
            'year' => $request->input('year'),
            'user_id' => auth()->user()->id,
        ]);

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
            $song->track = $request->file('track')->store('tracks');
        }

        $song->name = $request->input('name');
        $song->creators = $request->input('creators');
        $song->performers = $request->input('performers');
        $song->year = $request->input('year');
        $song->save();

        return redirect()->route('songs.index');
    }

    public function destroy(Song $song)
    {
        foreach ($song->verses as $verse) {
            $verse->delete();
        }

        if (is_file($song->track)) {
            Storage::delete($song->track);
        }

        $song->delete();

        return redirect()->route('songs.index');
    }
}
