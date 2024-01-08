@extends('layouts.app')
@section('content')
    <a href="{{ route('user.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> user</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>
    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>mo_no</th>
                <th>gender</th>
                <th>image</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->mo_no }}</td>
                    <td>{{ $user->gender }}</td>
                    <td><img src="{{ asset('user_img/' . $user->image) }}" height="70" width="80"></td>
                    <td>
                        <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
