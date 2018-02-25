@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('videos.update', [$video]) }}" class="video">
                    @method("PATCH")
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="name-help" placeholder="Enter video name" value="{{ old('name', $video->name) }}">
                        <small id="name-help" class="form-text text-muted">A name to help you recognise the video in a list</small>
                    </div>
                    <div class="form-group">
                        <ul class="available-slides">
                            @foreach ($video->song->verses as $verse)
                                <li class="slide" data-id="{{ $verse->id }}" data-words="{{ addslashes($verse->words) }}">
                                    {{ $verse->words }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="added-slides">

                        </div>
                        <div class="waveform" data-track="{{ route("songs.stream", [$video->song]) }}" data-seconds="{{ $video->song->seconds }}" style="background-image: url('{{ asset("storage/{$video->song->waveform}") }}'); ">
                            <div class="tracker"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary rewind d-none">rewind</button>
                    <button type="button" class="btn btn-secondary play d-none">play</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
