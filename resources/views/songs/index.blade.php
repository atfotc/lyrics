@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('songs.create') }}">Create new song</a>
                <ol>
                    @foreach ($songs as $song)
                        <li>
                            <a href="{{ route('songs.edit', [$song]) }}">{{ $song->name }}
                                @if ($song->seconds)
                                    ({{ $song->seconds }} {{ str_plural('second', $song->seconds) }})
                                @endif
                            </a> •
                            <a href="{{ route('songs.verses.index', [$song]) }}">verses</a> •
                            <form id="delete-{{ $song->id }}" action="{{ route('songs.destroy', [$song])}}" method="POST" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <a href="#" onclick="event.preventDefault(); confirm('Are you sure?') && document.getElementById('delete-{{ $song->id }}').submit(); ">delete</a>
                            </form>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection
