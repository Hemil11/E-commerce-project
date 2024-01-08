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
                                </table>
                                <form name="" id="variant_value_form" method="POST" data-id="{{ $variant->id }}">
                                    @csrf
                                    <table class="table table-bordered table-hover" id="dynamic_field">
                                        <tr id=''>
                                            <td>
                                                <input disabled type="text" 
                                                 class="form-control name_list"
                                                    value="Variant name" />
                                                </td>
                                                <input hidden type="text"  class="form-control start_price_list" value="" /></td>    
                                            <td>
                                                <input disabled type="text"
                                                    class="form-control variant value" value="Variant value" />
                                            </td>
                                            <td>
                                                <button type="button" name="remove" class="btn btn-danger remove" > <i
                                                        class="fas fa-trash-alt" ></i></button>
                                            </td>
                                        </tr>
                                        @foreach ($variant_values as $variant_value)
                                        <tr id=''>
                                            <td>
                                                <input disabled type="text" 
                                                 class="form-control name_list"
                                                    value="{{ $variant->name }}" />
                                                </td>
                                                <input hidden type="text"  class="form-control start_price_list" value="{{ $variant->id }}" /></td>    
                                            <td>
                                                <input type="text"  placeholder="Enter your variant value"
                                                    class="form-control variant value" value="{{ $variant_value->name }}" />
                                            </td>
                                            <td>
                                                <button type="button" name="remove" class="btn btn-danger remove" id="{{ $variant_value->id }}" data-id="{{ $variant_value->id }}" > <i
                                                        class="fas fa-trash-alt" ></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                    <input type="submit" class="btn btn-success" name="submit" id="submit"
                                        value="Submit">
                                    <button type="button" class="btn btn-primary" id="add">Add</button>
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
            var i = 1;

            $("#add").click(function() {
                var rowIndex = $('#dynamic_field tr').length;
                var currentAmount = rowIndex * 700;
                var addAmount = currentAmount + 700;

                $('#dynamic_field').append(
                    '<tr id="' + i +
                    '"><td><input disabled type="text" name="name" class="form-control start_price_list" value="{{ $variant->name }}" /><input hidden type="text" name="id" class="form-control start_price_list" value="{{ $variant->id }}" /></td><td><input type="text" name="value[]" placeholder="Enter your variant value" class="form-control variant value" value="" /></td><td><button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></button></td></tr>'
                );
                i++;
            });

            $("#submit").on('click', function(event) {
                event.preventDefault();

                // Use serializeArray() to convert form data to an array
                var formdata = $("#variant_value_form").serialize();
                var id = $("#variant_value_form").data('id');

                $.ajax({
                    url: "{{ route('variant.value.store') }}",
                    type: "POST",
                    data:  formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    success: function(result) {
                        // 
                    }
                });
            });

            $(document).on('click', '.remove', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{ route('variant.value.delete') }}",
                    type: "POST",
                    data:  {id:id},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    cache: false,
                    success: function(result) {
                            
                    }
                });
            });

            $(document).on('click', '.update', function() {
                // Handle update logic here using $(this).data('id')
            });
        });
    </script>
@endpush
