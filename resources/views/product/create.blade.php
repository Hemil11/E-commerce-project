@extends('layouts.app')
@push('links')
    <style>
        /* Define a custom error class */
        .error-text {
            color: red;
            /* Set the color to red */
            font-size: 12px;
            /* Optionally adjust the font size */
            /* Add any other desired styles */
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <form class="form" id="form-data" method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="category_name">Name:</label>
                <input type="text" id="category_name" class="form-control" name="name" placeholder="Name"
                    value="{{ old('name') }}" />
            </div>

            <!-- price input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="price">price :-</label>
                <input type="text" id="price" class="form-control" name="price" placeholder="price"
                    value="{{ old('price') }}" />
            </div>

            <!-- quantity input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="quantity">quantity :-</label>
                <input type="text" id="quantity" class="form-control" name="quantity" placeholder="quantity"
                    value="{{ old('quantity') }}" />
            </div>

            <!-- image input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="image">image :-</label>
                <input type="file" id="image" class="form-control" name="image" placeholder="image"
                    value="{{ old('image') }}" />
            </div>

            <!-- category_id input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="category_id">category :-</label>
                <select id="category_id" class="form-control" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Variant input -->
            <div class="form-outline mb-4">
                <div class="col-12">
                    <label class="form-label" for="variant">Variant:</label>
                    <input type="checkbox" class="form-check-input" id="showDropdowns" name="variant">
                </div>

                <select class="form-select" id="variant_type_dropdown" style="display: none;" name="variant_type"
                    class="form-control">
                    <option disabled selected value="">Select an option</option>
                    <option value="single_variant">single_variant</option>
                    <option value="multi_variant">multi_variant</option>
                </select>

                <div id="variant">
                    <div class="col-12" id="dropdown1" style="display: none;">
                        <label class="form-label" for="dropdown">Select Variant:</label>
                        <select class="form-select" id="dropdown" name="variant_id[]" class="form-control">
                            <option disabled selected value="">Select an option</option>
                            @foreach ($variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="variant" style="display: none;">
                        <div class="row" id="variant_add">
                            <div class="col-4">
                                <select class="form-control" name="variant_value_id[]" id="variant_id">
                                </select>
                            </div>
                            <div class="col-6">
                                <input type="text" name="variant_price[]" placeholder="Enter your variant price"
                                    class="form-control variant value" value="">
                            </div>
                            <div class="col-2">
                                <button type="button" name="remove" class="btn btn-danger remove"><i
                                        class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" name="add" id="add" class="btn btn-primary"><i
                                    class="fas fa-plus    "></i></button>
                        </div>
                    </div>

                    <div class="multi_variant" style="display: none;">
                        <div class="row" id="multi_variant_add">
                            <div class="col-3">
                                <select class="form-control" name="variant_value_id[]" id="variant_id">
                                </select>
                            </div>
                            <div class="col-3">
                                <select class="form-control" name="second_variant_value_id[]" id="second_variant_id">
                                </select>
                            </div>
                            <div class="col-5">
                                <input type="text" name="multi_variant_price[]" placeholder="Enter your variant price"
                                    class="form-control variant value" value="">
                            </div>
                            <div class="col-1">
                                <button type="button" name="remove" class="btn btn-danger remove"><i
                                        class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button type="button" name="add" id="add"
                                    class="btn btn-primary add-multi-variant"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- description input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="description">description :-</label>
                <textarea id="description" class="form-control" cols="30" rows="10" name="description">{{ old('description') }}</textarea>
            </div>
            <select name="another_variant_id[]" id="another_variant_id"></select>
            <select hidden name="second_another_variant_id[]" id="second_another_variant_id"></select>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">Add product</button>
        </form>
    </div>
    </div>
    <!-- Pills content -->
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $("#form-data").validate({
                errorClass: 'error-text', // Apply the custom error class
                errorElement: 'span',
                rules: {
                    name: {
                        required: true,
                    },
                    price: {
                        required: true,
                    },
                    quantity: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    variant_id: {
                        // Initial state, not required
                    },
                    variant_price: {
                        // Initial state, not required
                    },
                },
                messages: {
                    name: {
                        required: "This field is required"
                    },
                    price: {
                        required: "This field is required"
                    },
                    quantity: {
                        required: "This field is required"
                    },
                    image: {
                        required: "This field is required"
                    },
                    category_id: {
                        required: "This field is required"
                    },
                    description: {
                        required: "This field is required"
                    },
                    variant_id: {
                        required: "This field is required"
                    },
                    variant_price: {
                        required: "This field is required"
                    },
                },
            });

            // Conditionally adding rules when checkbox is checked
            $('#showDropdowns').change(function() {
                if ($(this).is(':checked')) {
                    $("#form-data").rules("add", {
                        variant_id: {
                            required: true,
                        },
                        variant_price: {
                            required: true,
                        },
                        messages: {
                            variant_id: {
                                required: "This field is required"
                            },
                            variant_price: {
                                required: "This field is required"
                            },
                        }
                    });
                } else {
                    $("#form-data").rules("remove", "variant_id");
                    $("#form-data").rules("remove", "variant_price");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var receivedData; // Declare a variable outside the AJAX scope

            $('#showDropdowns').change(function() {
                if ($(this).is(':checked')) {
                    $('#variant_type_dropdown').show();
                } else {
                    $('#variant_type_dropdown').hide();
                    $('#dropdown1').hide();
                    $('.variant').hide();
                }
            });

            $('#variant_type_dropdown').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue == 'single_variant') {
                    $('#dropdown1').show();
                    $('#dropdown').on('change', function() {
                        var selectedValue = $(this).val();
                        console.log("Selected option: " + selectedValue);
                        $('.variant').show();
                        $.ajax({
                            url: '{{ route('variant.value.data') }}',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                id: selectedValue
                            },
                            success: function(data) {

                                console.log(data);
                                getdata = data;
                                processData(getdata);
                                var selectList1 = $(
                                    '<select class="form-control" name="variant_value_id[]"></select>'
                                );
                                var selectList2 = $(
                                    '<select class="form-control" name="another_variant_id[]"></select>'
                                );

                                $.each(data, function(index, item) {

                                    selectList1.append('<option value="' + item
                                        .id + '">' + item
                                        .name + '</option>');
                                    selectList2.append('<option value="' + item
                                        .id +
                                        '">' + item.name + '</option>');
                                });

                                // Append options to the respective select elements
                                $('.variant .row').find(
                                        'select[name="variant_value_id[]"]')
                                    .html(selectList1
                                        .html());
                                $(document).find('select[name="another_variant_id[]"]')
                                    .html(selectList2.html());

                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                    });

                    function processData(data) {
                        console.log('Processing data:', data);
                    }

                    $('.variant').on('click', '#add', function() {

                        var selectOptions = $('#another_variant_id').html();
                        var newDiv = '<div class="row">' +
                            '<div class="col-4">' +
                            '<select class="form-control" name="variant_value_id[]">' +
                            selectOptions +
                            '</select>' +
                            '</div>' +
                            '<div class="col-6">' +
                            '<input type="text" name="variant_price[]" placeholder="Enter your variant value" class="form-control variant value" value="">' +
                            '</div>' +
                            '<div class="col-2">' +
                            '<button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></button>' +
                            '</div>' +
                            '</div>';

                        // Append the new div
                        $('#variant_add').append(newDiv);
                    });


                    // Handling removal of dynamically added elements
                    $('.variant').on('click', '.remove', function() {
                        $(this).closest('.row').remove();
                    });
                } else if (selectedValue == 'multi_variant') {
                    $('#dropdown1').show();
                    $('#dropdown').attr('multiple', 'multiple');
                    $('#dropdown').on('change', function() {
                        var selectedValue = $(this).val();
                        console.log(selectedValue);
                        $('.multi_variant').show();

                        $.ajax({
                            url: '{{ route('variant.value.data') }}',
                            method: 'GET',
                            dataType: 'json',
                            data: {
                                id: selectedValue
                            },
                            success: function(data) {
                                $.each(data, function(index, variantArray) {
                                    console.log('Variant Array:', variantArray);
                                    var selectList1 = $(
                                        '<select class="form-control" id="variant_id"></select>'
                                    );
                                    var selectList2 = $(
                                        '<select class="form-control" id="second_variant_id"></select>'
                                    );
                                    var selectList3 = $(
                                        '<select class="form-control" id="another_variant_id"></select>'
                                    );
                                    var selectList4 = $(
                                    '<select class="form-control" id="second_another_variant_id"></select>'
                                    );

                                    
                                    $.each(variantArray, function(innerIndex,
                                    item) {
                                        console.log(item.name); 
                                        selectList1.append(
                                            '<option value="' + variantArray
                                            .id + '">' + variantArray
                                            .name + '</option>');
                                        selectList2.append(
                                            '<option value="' + variantArray
                                            .id +
                                            '">' + variantArray.name +
                                            '</option>');
                                        selectList3.append(
                                            '<option value="' + variantArray
                                            .id + '">' + variantArray
                                            .name + '</option>');
                                        selectList4.append(
                                            '<option value="' + variantArray
                                            .id +
                                            '">' + variantArray.name +
                                            '</option>');
                                    });
                                    // Append options to the respective select elements
                                    if (index == 0) {
                                        $(document).find(
                                                'select[id="variant_id"]')
                                            .html(selectList1
                                                .html());

                                        $(document).find(
                                                'select[id="another_variant_id"]'
                                            )
                                            .html(selectList3
                                                .html());
                                    } else if (index == 1) {
                                        $(document).find(
                                                'select[id="second_variant_id"]'
                                            )
                                            .html(selectList2
                                                .html());
                                        $(document).find(
                                                'select[id="second_another_variant_id"]'
                                            )
                                            .html(selectList4
                                                .html());
                                    }
                                });

                            },
                            error: function(error) {
                                console.error('Error:', error);
                            }
                        });
                        $('.multi_variant').on('click', '.add-multi-variant', function() {
                            var selectOptions1 = $('#another_variant_id').html();
                            var selectOptions2 = $('#second_another_variant_id').html();

                            var newDiv = `<div class="row">
                                        <div class="col-3">
                                            <select class="form-control" name="variant_value_id[]">${selectOptions1}</select>
                                        </div>
                                        <div class="col-3">
                                            <select class="form-control" name="second_variant_value_id[]">${selectOptions2}</select>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="multi_variant_price[]" placeholder="Enter your variant price" class="form-control variant value" value="">
                                        </div>
                                        <div class="col-1">
                                            <button type="button" name="remove" class="btn btn-danger remove"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>`;
                                    // $('#variant_add').empty();
                            $('#multi_variant_add').append(newDiv);
                        });
                    });

                }
            });

        });
    </script>
@endpush
