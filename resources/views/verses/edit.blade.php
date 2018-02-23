@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('songs.verses.update', [$song, $verse]) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="words">Words</label>
                        <textarea class="form-control" id="words" name="words" aria-describedby="words-help" placeholder="Enter verse words">{{ old('words', $verse->words) }}</textarea>
                        <small id="words-help" class="form-text text-muted">Words of this verse</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
