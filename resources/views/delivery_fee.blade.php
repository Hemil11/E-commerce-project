@extends('layouts.app')

@section('content')
    <div id="maindiv">
        <div class="border">
            <div class="m-3" id="subdiv">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <form name="" id="delivery_fee_value_form" method="POST">
                                    @csrf
                                    <table class="table table-bordered table-hover" id="dynamic_field">
                                        @foreach ($delivery_fees as $delivery_fee)
                                            <tr>
                                                <td>
                                                    <input disabled type="text" name="start_price[]"
                                                        placeholder="Enter your start_price"
                                                        class="form-control name_list" value="{{ $delivery_fee->start_price }}" />
                                                    <input hidden type="text" name="id[]"
                                                        placeholder="Enter your start_price" class="form-control id_list"
                                                        value="{{ $delivery_fee->id }}" />
                                                </td>
                                                <td>
                                                    <select name="condition[]" disabled="disabled" class="form-control">
                                                        <option value="or" {{ $delivery_fee->condition == 'or' ? 'selected' : '' }}>
                                                            OR</option>
                                                        <option value="and" {{ $delivery_fee->condition == 'and' ? 'selected' : '' }}>
                                                            AND</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="check[]" disabled="disabled" class="form-control">
                                                        <option value="<" {{ $delivery_fee->check == '<' ? 'selected' : '' }}><</option>
                                                        <option value="=" {{ $delivery_fee->check == '=' ? 'selected' : '' }}>=</option>
                                                        <option value=">" {{ $delivery_fee->check == '>' ? 'selected' : '' }}>></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input disabled type="text" name="fees[]"
                                                        placeholder="Enter your start_price"
                                                        class="form-control name_list" value="{{ $delivery_fee->fees }}" />
                                                </td>
                                                <td>
                                                    <button type="button" name="remove" class="btn btn-danger remove"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                    <button type="button" name="update" class="btn btn-primary update"
                                                        data-id="{{ $delivery_fee->id }}"><i
                                                            class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
                                    <button type="button" class="btn btn-primary " id="add">Add</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            var i = {{ count($delivery_fees) }}; // Initialize i with the count of existing rows

            $("#add").click(function() {
                var rowIndex = $('#dynamic_field tr').length;
                var addamount = 700;

                var currentAmont = rowIndex * 700;
                addamount += currentAmont;

                addamount += 700;
                i++;

                var newRow = `<tr>
                    <td>
                        <input  type="text" name="start_price[]" placeholder="Enter your start_price"
                            class="form-control name_list" />
                        <input hidden type="text" name="id[]" placeholder="Enter your start_price" class="form-control id_list" />
                    </td>
                    <td>
                        <select class='form-control' name="condition[]">
                            <option value="or">OR</option>
                            <option value="and">AND</option>
                        </select>
                    </td>
                    <td>
                        <select class='form-control' name="check[]">
                            <option value="<"><</option>
                            <option value="=">=</option>
                            <option value=">">></option>
                        </select>
                    </td>
                    <td>
                        <input  type="text" name="fees[]" placeholder="Enter your fee"
                            class="form-control name_list" />
                    </td>
                    <td>
                        <button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" name="update" class="btn btn-primary update" data-id="${i}"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>`;

                $('#dynamic_field').append(newRow);
            });

            $("#submit").on('click', function(event) {
                event.preventDefault();
                var formdata = $("#delivery_fee_value_form").serialize();

                $.ajax({
                    url: "{{ route('delivery.fee.store') }}",
                    type: "POST",
                    data: formdata,
                    cache: false,
                    success: function(result) {
                        var newRow = `<tr>
                    <td>
                        <input  type="text" name="start_price[]" placeholder="Enter your start_price"
                            class="form-control name_list" />
                        <input hidden type="text" name="id[]" placeholder="Enter your start_price" class="form-control id_list" />
                    </td>
                    <td>
                        <select class='form-control' name="condition[]">
                            <option value="or">OR</option>
                            <option value="and">AND</option>
                        </select>
                    </td>
                    <td>
                        <select class='form-control' name="check[]">
                            <option value="<"><</option>
                            <option value="=">=</option>
                            <option value=">">></option>
                        </select>
                    </td>
                    <td>
                        <input  type="text" name="fees[]" placeholder="Enter your fee"
                            class="form-control name_list" />
                    </td>
                    <td>
                        <button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" name="update" class="btn btn-primary update" data-id="${i}"><i class="fas fa-edit"></i></button>
                    </td>
                </tr>`;

                $('#dynamic_field').append(newRow);
                    }
                });
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
            });

            $(document).on('click', '.update', function() {
                var id = $(this).data('id');
                // Implement your update logic here
            });

            $(window).on('beforeunload', function() {
                return 'Are you sure you want to leave? Your changes may not be saved...??';
            });
        });
    </script>
@endpush
