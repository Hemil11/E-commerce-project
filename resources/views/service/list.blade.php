@extends('layouts.app')

@section('content')
    <a href="{{ route('service.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> service</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>category</th>
                <th>description</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->category->name }}</td>
                    <td>{{ $service->description }}</td>
                    <td>
                        <a href="{{ route('service.edit', ['id' => $service->id]) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('service.delete', ['id' => $service->id]) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
@endsection
