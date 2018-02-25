@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('videos.create') }}">Create new video</a>
                <ol>
                    @foreach ($videos as $video)
                        <li>
                            <a href="{{ route('videos.edit', [$video]) }}">{{ $video->name }}</a> •
                            <form id="delete-{{ $video->id }}" action="{{ route('videos.destroy', [$video])}}" method="POST" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <a href="#" onclick="event.preventDefault(); confirm('Are you sure?') && document.getElementById('delete-{{ $video->id }}').submit(); ">delete</a>
                            </form>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection
