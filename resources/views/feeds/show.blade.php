@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="pull-left">{{ $feed->name }}</h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('feeds.edit', $feed) }}">Edit</a>
    </div>
    @foreach ($feed->images as $image)
        <img src="{{ $image->url }}" />
    @endforeach
</div>
@endsection
