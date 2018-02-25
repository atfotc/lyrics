@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('videos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name-help" placeholder="Enter video name" value="{{ old('name') }}">
                        <small id="name-help" class="form-text text-muted">A name to help you recognise the video in a list</small>
                    </div>
                    <div class="form-group">
                        <label for="song_id">Song</label>
                        <select class="form-control" id="song_id" name="song_id" aria-describedby="song-help">
                            <option value="">Select a song</option>
                            @foreach ($songs as $song)
                                <option
                                    value="{{ $song->id }}"
                                    @if (old("song_id") === $song->id)
                                        selected="selected"
                                    @endif
                                    @if ($song->duration === null)
                                        disabled="disabled"
                                    @endif
                                >
                                    {{ $song->name }}
                                    @if ($song->duration === null)
                                        (still processing)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <small id="song-help" class="form-text text-muted">The song this video is based on</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
