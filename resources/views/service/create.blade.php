@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('service.store') }}">
        @csrf

        <div class="form-outline mb-4">
            <label class="form-label" for="category">Category :-</label>
            <select name="categroy_id" class="form-control" id="">
                @foreach ($categroies as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <!-- description input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="description">Description :-</label>
            <textarea id="description" class="form-control" name="description" placeholder="description"
                value="{{ old('description') }}"></textarea>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">Add</button>
    </form>
    </div>
    </div>
@endsection
