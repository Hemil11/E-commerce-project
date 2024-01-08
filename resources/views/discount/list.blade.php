@extends('layouts.app')

@section('content')
    <a href="{{ route('discount.create') }}" class="btn btn-primary  "><i class="fa fa-add"></i> discount</a>
    <a href="{{ route('admin.index') }}" class="btn btn-primary  "><i class="fa fa-long-arrow-left"></i> back</a>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>code</th>
                <th>start_date</th>
                <th>end_date</th>
                <th>limit</th>
                <th>discount</th>
                <th>is_active</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount->id }}</td>
                    <th>{{ $discount->code }}</th>
                    <td>{{ $discount->start_date }}</td>
                    <td>{{ $discount->end_date }}</td>
                    <td>{{ $discount->limit }}</td>
                    <td>{{ $discount->discount }}</td>
                    <td>{{ $discount->is_Active == 0 ? 'not active' : 'active' }}</td>
                    <td>
                        <a href="{{ route('discount.edit', ['id' => $discount->id]) }}" class="btn btn-primary">edit</a>
                        <a href="{{ route('discount.delete', ['id' => $discount->id]) }}" class="btn btn-danger">delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
