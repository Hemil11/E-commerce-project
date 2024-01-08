@extends('layouts.app')
@section('content')
    <a href="{{ route('veriant.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> veriant</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>status</th>
                <th>value</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($veriants as $veriant)
                <tr>
                    <td>{{ $veriant->id }}</td>
                    <td>{{ $veriant->name }}</td>
                    <td>{{ $veriant->status == 1 ? 'active' : 'inactive' }}</td>
                    <td>
                        <a href="{{ route('veriant.value.add', ['id' => $veriant->id]) }}" class="btn btn-primary">view</a>
                    </td>
                    <td>
                        <a href="{{ route('veriant.edit', ['id' => $veriant->id]) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('veriant.delete', ['id' => $veriant->id]) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
