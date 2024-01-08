@extends('layouts.app')
@section('content')
        <form class="form" method="POST" action="{{ route("categroy.store") }}" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="categroy_name">Name :-</label>
                <input type="text" id="categroy_name" class="form-control" name="name" placeholder="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="categroy_image">Image :-</label>
                <input type="file" id="categroy_image" class="form-control" name="image" placeholder="image"
                    value="{{ old('image') }}" />
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">Add</button>
        </form>
    </div>
    </div>
@endsection
