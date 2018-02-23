@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('songs.update', [$song]) }}" enctype="multipart/form-data">
                    @method("PATCH")
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name-help" placeholder="Enter song name" value="{{ old('name', $song->name) }}">
                        <small id="name-help" class="form-text text-muted">A name to help you recognise the song in a list</small>
                    </div>
                    <div class="form-group">
                        <label for="track">Audio file</label>
                        <input type="file" class="form-control-file" id="track" name="track">
                        <small id="track-help" class="form-text text-muted">An mp3 file of the song</small>
                    </div>
                    <div class="form-group">
                        <label for="creators">Creators</label>
                        <input type="text" class="form-control" id="creators" name="creators" aria-describedby="creators-help" placeholder="Enter the names of the song creators" value="{{ old('creators', $song->creators) }}">
                        <small id="creators-help" class="form-text text-muted">A list of the people who helped to create the song</small>
                    </div>
                    <div class="form-group">
                        <label for="performers">Performers</label>
                        <input type="text" class="form-control" id="performers" name="performers" aria-describedby="performers-help" placeholder="Enter the names of the song performers" value="{{ old('performers', $song->performers) }}">
                        <small id="performers-help" class="form-text text-muted">A list of the people who helped to perform the song</small>
                    </div>
                    <div class="form-group">
                        <label for="performers">Year</label>
                        <input type="text" class="form-control" id="year" name="year" aria-describedby="year-help" placeholder="Enter the year the song was performed" value="{{ old('year', $song->year) }}">
                        <small id="year-help" class="form-text text-muted">The year the song was created/performed</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
