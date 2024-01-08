@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('veriant.update') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registerName">Name :-</label>
            <input type="text" id="registerName" class="form-control" name="name" placeholder="name"
                value="{{ $veriant->name }}" />
            <input type="text" id="registerName" class="form-control" name="id" hidden placeholder="name"
                value="{{ $veriant->id }}" />
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror     <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registerName">status :-</label>
            <select name="status" class="form-control" id="">
                <option value="1" {{ $veriant->status == 1 ? "selected" : "" }}>active</option>
                <option value="0" {{ $veriant->status == 0 ? "selected" : "" }}>inactive</option>
            </select>
        </div>
        
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">update</button>
    </form>
    </div>
    </div>
@endsection
