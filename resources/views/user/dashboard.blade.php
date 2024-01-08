@extends('layouts.app')

@section('content')

    <div class="row">
        <h4 class="d-flex justify-content-center mt-4 text text-bold">All Categroy</h4>
        @foreach ($categories as $category)
            <div class="col-4">
                <div class="m-1">
                    <a href="{{ route('category.product',['id'=>$category->id]) }}" class=" list-group-item btn btn-primary font-weight-bold ">
                        <img src="{{ asset('category_img/' . $category->image) }}"
                            class='float-left rounded-circle text-bold ' height="100" width="100" alt="">
                        {{ $category->name }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <a href="{{ route('product.all') }}" class="btn btn-primary m-3 "  style="float:right;"> All Product <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
@endsection

