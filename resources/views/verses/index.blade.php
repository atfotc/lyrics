@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('songs.verses.create', [$song]) }}">Create new verse</a>
                <ol>
                    @foreach ($verses as $verse)
                        <li>
                            <a href="{{ route('songs.verses.edit', [$song, $verse]) }}">{!! nl2br($verse->words) !!}</a> •
                            <form id="delete-{{ $verse->id }}" action="{{ route('songs.verses.destroy', [$song, $verse])}}" method="POST" style="display: inline">
                                @method('DELETE')
                                @csrf
                                <a href="#" onclick="event.preventDefault(); confirm('Are you sure?') && document.getElementById('delete-{{ $verse->id }}').submit(); ">delete</a>
                            </form>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
@endsection
