@extends('layouts.app')

@section('content')
    
<div class="container mt-5">
    <h1 class="d-flex justify-content-center mt-4">
        What Can us Help you??
    </h1>
    <a href="{{ Auth::user()->user_type == 1 ? route('admin.index') : route('user.index')  }}" class="btn btn-primary btn-block m-3">back</a>
    <p class="text-center" >You are loggined</p>
</div>
</div>

@endsection