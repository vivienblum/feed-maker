@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="pull-left">{{ $feed->name }}</h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('feeds.edit', $feed) }}">Edit</a>
    </div>
    <div class="feed-image-container">
        @foreach ($images as $image)
            <div>
                <img class="feed-image-item image-container" src="{{ $image['url'] }}" loading="lazy"/>
                <div class="feed-image-item colors-container">
                    <div class="average-color" style="background-color: {{ $image->getColorHex('average') }};"></div>
                    <div class="dominant-colors">
                        @foreach ($image->colors as $color)
                            @php($hex = App\Services\ColorsGetter::rgbToHex([
                                $color['r'],
                                $color['g'],
                                $color['b'],
                            ]))
                            <div style="background-color: {{ $hex }};"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
