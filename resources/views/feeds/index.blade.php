@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Feeds</h2>
    <ul class="list-group">
        @foreach ($feeds as $feed)
            <li class="list-group-item">{{ $feed->name }}</li>
        @endforeach
    </ul>
</div>
@endsection
