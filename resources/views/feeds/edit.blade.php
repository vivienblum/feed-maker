@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit {{ $feed->name }}</h2>
            </div>
        </div>
    </div>

    <form action="{{ route('feeds.update', $feed->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" value="{{ $feed->name }}" class="form-control" placeholder="Name">
            </div>
            <input type="file" name="images[]" accept="image/*" multiple>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
</div>
@endsection
