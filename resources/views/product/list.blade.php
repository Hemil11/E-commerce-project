@extends('layouts.app')

@section('content')
    <a href="{{ route('product.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> Product</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>quantity</th>
                <th>categroy_id</th>
                <th>description</th>
                <th>image</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img class="rounded-circle" src="{{ asset('product_img/' . $product->image) }}" height="70"
                            width="80"></td>
                    <td>
                        <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
