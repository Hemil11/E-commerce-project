@extends('layouts.app')
@section('content')
    <a href="{{ route('categroy.list') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> Categroy</a>
    <a href="{{ route('product.list') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> Product</a>
    <a href="{{ route('service.list') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> Service</a>
    <a href="{{ route('discount.list') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> Discount</a>
    <a href="{{ route('user.list') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> User</a>
    <a href="{{ route('dashboard.edit') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> Edit</a>
    <a href="{{ route('delivery.fee') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> delivery fee</a>
    <a href="{{ route('veriant.index') }}" class="btn btn-primary m-3 "><i class="fa fa-add"></i> variant </a>
    <a href="{{ route('logout') }}" class="btn btn-danger m-3 "> Logout</a>
@endsection
                    