@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('veriant.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registerName">Name :-</label>
            <input type="text" id="registerName" class="form-control" name="name" placeholder="name" value="" />
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registerName">stat   us :-</label>
            <select name="status" class="form-control" id="">
                <option value="1">active</option>
                <option value="0">inactive</option>
            </select>
        </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">add</button>
        </form>
        </div>
        </div>
    @endsection
