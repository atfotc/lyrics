<?php

namespace App\Http\Controllers;

use App\Song;
use App\Verse;
use Illuminate\Http\Request;

class VerseController extends Controller
{
    public function index(Song $song)
    {
        return view('verses.index', [
            'song' => $song,
            'verses' => $song->verses,
        ]);
    }

    public function create(Song $song)
    {
        return view('verses.create', [
            'song' => $song,
        ]);
    }

    public function store(Request $request, Song $song)
    {
        Verse::create([
            'words' => $request->input('words'),
            'song_id' => $song->id,
        ]);

        return redirect()->route('songs.verses.index', [$song]);
    }

    public function edit(Song $song, Verse $verse)
    {
        return view('verses.edit', [
            'song' => $song,
            'verse' => $verse,
        ]);
    }

    public function update(Request $request, Song $song, Verse $verse)
    {
        $verse->words = $request->input('words');
        $verse->save();

        return redirect()->route('songs.verses.index', [
            'song' => $song,
        ]);
    }

    public function destroy(Song $song, Verse $verse)
    {
        $verse->delete();

        return redirect()->route('songs.verses.index', [
            'song' => $song,
        ]);
    }
}
