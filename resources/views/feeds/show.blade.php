@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="pull-left">{{ $feed->name }}</h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('feeds.edit', $feed) }}">Edit</a>
    </div>
    <div class="feed-image-container">
        @foreach ($images as $image)
            <img class="feed-image-item" src="{{ $image['url'] }}" loading="lazy"/>
        @endforeach
    </div>
</div>
@endsection
