@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="registerName">Name :-</label>
            <input type="text" id="registerName" class="form-control" name="name" placeholder="name"
                value="{{ old('name') }}" />
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="registeremail">email :-</label>
            <input type="email" id="registerName" class="form-control" name="email" placeholder="email"
                value="{{ old('email') }}" />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="registerpassword">password :-</label>
            <input type="password" id="registerName" class="form-control" name="password" placeholder="password"
                value="{{ old('password') }}" />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="registermo_no">mo_no :-</label>
            <input type="number" id="registerName" class="form-control" name="mo_no" placeholder="mo_no"
                value="{{ old('mo_no') }}" />
            @error('mo_no')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="registermo_no">gender :-</label>&nbsp;&nbsp;&nbsp;
            <input type="radio" id="registerName" value="male" name="gender"
                placeholder="gender" />male&nbsp;&nbsp;&nbsp;
            <input type="radio" id="registerName" value="female" name="gender" placeholder="gender" />female
            @error('gender')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="registerimage">image :-</label>
            <input type="file" id="registerName" class="form-control" name="image" placeholder="image"
                value="{{ old('image') }}" />
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
    </form>
    </div>
    </div>
@endsection
