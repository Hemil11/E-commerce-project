@extends('layouts.app')

@section('content')
    
    <form class="form" method="POST" action="{{ route('discount.store') }}">
        @csrf
        <!-- code input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="discount_code">code :-</label>
            <input type="text" id="discount_code" class="form-control" name="code" placeholder="code"
                value="{{ old('code') }}" />
        </div>
        @error('code')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- start_date input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="discount_start_date">start_date :-</label>
            <input type="date" id="discount_start_date" class="form-control" name="start_date"
                placeholder="start_date" value="{{ old('start_date') }}" />
        </div>
        @error('start_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- end_date input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="discount_end_date">end_date :-</label>
            <input type="date" id="discount_end_date" class="form-control" name="end_date" placeholder="end_date"
                value="{{ old('end_date') }}" />
        </div>
        @error('end_date')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- limit input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="discount_limit">limit :-</label>
            <input type="number" id="discount_limit" class="form-control" name="limit" placeholder="limit"
                value="{{ old('limit') }}" />
        </div>
        @error('limit')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <!-- discount input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="discount_discount">discount :-</label>
            <input type="number" id="discount_discount" class="form-control" name="discount" placeholder="discount"
                value="{{ old('discount') }}" />
        </div>
        @error('discount')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">Create</button>
    </form>
    </div>
    </div>
@endsection
    