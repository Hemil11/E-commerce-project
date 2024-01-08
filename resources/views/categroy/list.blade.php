@extends('layouts.app')
@section('content')
<a href="{{ route('categroy.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> categroy</a>
<a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>

<table class="table" >
<thead>
<tr>
    <th>id</th>
    <th>name</th>
    <th>image</th>
    <th>action</th>
</tr>
</thead>
<tbody>
@foreach ($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td><img src="{{ asset('category_img/'.$category->image) }}" height="70" width="80"></td>
        <td>
            <a href="{{ route('categroy.edit', ['id' => $category->id]) }}" class="btn btn-primary">edit</a>
            <a href="{{ route("categroy.delete", ['id' => $category->id]) }}" class="btn btn-danger">delete</a> 
        </td>
    </tr>
@endforeach
</tbody>
</table>
</div></div>

@endsection

    