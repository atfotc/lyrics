<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return view('videos.index', [
            'videos' => auth()->user()->videos,
        ]);
    }

    public function create()
    {
        return view('videos.create', [
            'songs' => auth()->user()->songs,
        ]);
    }

    public function store(Request $request)
    {
        $video = Video::create([
            'name' => $request->input('name'),
            'song_id' => $request->input('song_id'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('videos.edit', [$video]);
    }

    public function edit(Video $video)
    {
        return view('videos.edit', [
            'video' => $video,
        ]);
    }

    public function update(Request $request, Video $video)
    {
    }

    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('videos.index');
    }
}
