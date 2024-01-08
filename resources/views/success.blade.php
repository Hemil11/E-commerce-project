@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('icons8-success.gif') }}" class="img-fluid mx-auto d-block mt-5" alt="">
                <h1 class="d-flex justify-content-center ">Your Payment is Successfull...!!</h1>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left "></i>  Back</a>
                <a href="{{ route('order.success') }}" class="btn btn-primary m-3">Details</a>
            </div>
        </div>
    </div>
@endsection
