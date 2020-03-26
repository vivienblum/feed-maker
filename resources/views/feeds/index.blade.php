@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feeds</h2>
    <ul class="list-group">
        @foreach ($feeds as $feed)
            <a href="{{ route('feeds.show', $feed) }}">
                <li class="list-group-item">{{ $feed->name }}</li>
            </a>
        @endforeach
    </ul>
</div>
@endsection
