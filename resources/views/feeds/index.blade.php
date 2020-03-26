@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feeds</h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('feeds.create') }}">Create</a>
    </div>
    <ul class="list-group">
        @foreach ($feeds as $feed)
            <a href="{{ route('feeds.show', $feed) }}">
                <li class="list-group-item">{{ $feed->name }}</li>
            </a>
        @endforeach
    </ul>
</div>
@endsection
