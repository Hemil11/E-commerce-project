@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('title.change') }}" enctype="multipart/form-data">
        @csrf
        <!-- title input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registertitle">title :-</label>
            <input type="text" id="registertitle" class="form-control" name="title" placeholder="title"
                value="{{ title() }}" />
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- image input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="image">image :-</label>
            <input type="file" id="image" class="form-control" name="image" placeholder="image"
                value="{{ old('image') }}" />
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block mb-3">Edit</button>
    </form>
@endsection
