@extends('layouts.app')

@section('content')
    <form class="form" method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data">
        @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="categroy_name">Name :-</label>
            <input type="text" id="" class="form-control" name="id" value="{{ $product->id }}">
            <input type="text" id="categroy_name" class="form-control" name="name" value="{{ $product->name }}"
                placeholder="name" value="{{ old('name') }}" /> 
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- price input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="price">price :-</label>
            <input type="text" id="price" class="form-control" name="price" value="{{ $product->price }}"
                placeholder="price" value="{{ old('price') }}" />
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- quantity input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="quantity">quantity :-</label>
            <input type="text" id="quantity" class="form-control" name="quantity" value="{{ $product->quantity }}"
                placeholder="quantity" value="{{ old('quantity') }}" />
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- category_id input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="category_id">category :-</label>
            <select id="" class="form-control" name="category_id" value="{{ $product->categroy_id }}"
                value="{{ old('category_id') }}">
                @foreach ($categories as $categroy)
                    <option value="{{ $categroy->id }}">{{ $categroy->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Variant input -->
        <div class="form-outline mb-4">
            <div class="col-12">
                <label class="form-label" for="variant">Variant:</label>
                <input type="checkbox" {{ $product->variant_type != null ? 'checked' : '' }} class="form-check-input"
                    id="showDropdowns" name="variant">
            </div>

            <select class="form-select" id="varint_type_dropdown" style="display: none;" name="varint_type"
                class="form-control">
                <option disabled selected value="">Select an option</option>
                <option value="single_variant" {{ $product->variant_type == 'single_variant' ? 'selected' : '' }}>
                    single_variant</option>
                <option value="multi_variant" {{ $product->variant_type == 'multi_variant' ? 'selected' : '' }}>
                    multi_variant</option>
            </select>

            <div class="col-12" id="dropdown1" style="display: none;">
                <label class="form-label" for="dropdown">Select Variant:</label>
                <select class="form-select" id="dropdown" name="variant" class="form-control">
                    <option disabled selected value="">Select an option</option>
                    @foreach ($variants as $variant)
                        <option value="{{ $variant->id }}" {{ $variant->id == $product->variant_id ? 'selected' : '' }}>
                            {{ $variant->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div id="variant_container">
                @foreach ($product_variants as $product_variant)
                    <div class="row variant_row">
                        <div class="col-4">
                            <select class="form-control variant_id" name="product_variant_id[]">
                                <option value="{{ $product_variant->variant_id }}">
                                    {{ $product_variant->variant_value->name }}</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <input type="text" name="product_variant_price[]" placeholder="Enter your variant price"
                            class="form-control variant_price" value="{{ $product_variant->price }}">
                            <input hidden type="text" name="product_variant_value_id[]" placeholder="Enter your variant price"
                            class="form-control variant_price" value="{{ $product_variant->id }}">
                        </div>
                        <div class="col-2">
                            <button type="button" data-id="{{ $product_variant->id }}" name="remove" class="btn btn-danger remove_variant"><i
                                    class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>



            <div class="variant" style="display: none;">

                <div class="row" id="variant_add">
                    <div class="col-4">
                        <select class="form-control" name="variant_id[]" id="variant_id">
                        </select>
                    </div>
                    <div class="col-6">
                        <input type="text" name="variant_price[]" placeholder="Enter your variant price"
                            class="form-control variant value" value="">
                    </div>
                    <div class="col-2">
                        <button type="button" name="remove" id="remove" class="btn btn-danger remove"><i
                                class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" name="add" id="add" class="btn btn-primary"><i
                            class="fas fa-plus    "></i></button>
                </div>
            </div>
        </div>

        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="product_image">image :-</label>
            <input type="file" id="product_image" class="form-control" name="image" placeholder="image"
                value="{{ old('image') }}" />
        </div>

        <!-- description input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="description">description :-</label>
            <textarea id="" class="form-control" cols="30" rows="10" name="description" value=""> {{ $product->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <select hidden name="another_variant_id[]" id="another_variant_id"></select>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-3">Add</button>
    </form>
    </div>
    </div>
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

            if ($('#showDropdowns').attr('checked', 'checked')) {
                $('#varint_type_dropdown').show();
                $('#dropdown1').show();
            } else {
                $('#varint_type_dropdown').hide();
                $('#dropdown1').hide();
                $('.variant').hide();
            }

            $('#showDropdowns').change(function() {
                if ($(this).is(':checked')) {
                    $('#varint_type_dropdown').show();
                } else {
                    $('#varint_type_dropdown').hide();
                    $('#dropdown1').hide();
                    $('.variant').hide();
                }
            });

            $('#varint_type_dropdown').on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue == 'single_variant') {
                    $('#dropdown1').show();
                } else if (selectedValue == 'multi_variant') {

                }
            });
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
                        getdata = data;
                        processData(getdata);
                        var selectList1 = $(
                            '<select class="form-control" name="variant_id[]"></select>');
                        var selectList2 = $(
                            '<select class="form-control" name="another_variant_id[]"></select>'
                        );

                        $.each(data, function(index, item) {
                            selectList1.append('<option value="' + item.id + '">' + item
                                .name + '</option>');
                            selectList2.append('<option value="' + item.id +
                                '">' + item.name + '</option>');
                        });

                        // Append options to the respective select elements
                        $('.variant .row').find('select[name="variant_id[]"]').html(selectList1
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
                    '<select class="form-control" name="variant_id[]">' + selectOptions + '</select>' +
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
            $('#variant_container').on('click', '.remove_variant', function() {
                var selectedId = $(this).data('id'); 
                console.log(selectedId);
                $(this).closest('.row').remove();
                $.ajax({
                    url: '{{ route("product.variant.delete") }}',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        id: selectedId
                    },
                    success: function(data) {
                        getdata = data;
                        processData(getdata);
                        var selectList1 = $(
                            '<select class="form-control" name="variant_id[]"></select>');
                        var selectList2 = $(
                            '<select class="form-control" name="another_variant_id[]"></select>'
                        );

                        $.each(data, function(index, item) {
                            selectList1.append('<option value="' + item.id + '">' + item
                                .name + '</option>');
                            selectList2.append('<option value="' + item.id +
                                '">' + item.name + '</option>');
                        });

                        // Append options to the respective select elements
                        $('.variant .row').find('select[name="variant_id[]"]').html(selectList1
                            .html());
                        $(document).find('select[name="another_variant_id[]"]')
                            .html(selectList2.html());

                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endpush
