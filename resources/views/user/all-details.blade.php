@extends('layouts.app')

@push('links')
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: blue
        }

        .profile-button {
            background: blue;
            box-shadow: none;
            border: none
        }

        .profile-button:hover {
            background: blue
        }

        .profile-button:focus {
            background: blue;
            box-shadow: none
        }

        .profile-button:active {
            background: blue;
            box-shadow: none
        }

        .back:hover {
            color: blue;
            cursor: pointer
        }

        .labels {
            font-size: 11px
        }

        .add-experience:hover {
            background: blue;
            color: #fff;
            cursor: pointer;
            border: solid 1px #BA68C8
        }
    </style>
@endpush

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    @if ($user->image)
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                class="rounded-circle mt-5" width="150px" src="{{ asset('user_img/' . $user->image) }}">
                        </div>
                    @elseif ($user->image == null)
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px"
                                src="{{ asset('blank-profile-picture-973460_640.webp') }}">
                        </div>
                    @endif
                    <span class="font-weight-bold">{{ $user->name }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                </div>
            </div>
            <!-- New input fields for user details -->
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form action="{{ route('update.details') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <!-- New input fields -->
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Name</label><input type="text"
                                    class="form-control" name="name" placeholder="first name" value="{{ $user->name }}"></div>
                            <div class="col-md-6"><label class="labels">Surname</label><input type="text"
                                    class="form-control" value="{{  $user->surname  }}" name="surname" placeholder="surname"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text"
                                    class="form-control" name="mo_no" placeholder="enter phone number" value="{{ $user->mo_no }}"></div>
                            <div class="col-md-6"><label class="labels">Gender</label> 
                            <select class="form-control" name="gender"> 
                                <option {{ $user->gender == "male" ? 'selected' : '' }} value="male">male</option>
                                <option {{ $user->gender == "female" ? 'selected' : '' }} value="female">female</option>
                                <option {{ $user->gender == "other" ? 'selected' : '' }} value="other">other</option>selected
                            </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Birth Date</label><input type="date"
                                    class="form-control" name="birth_date" placeholder="enter birth date" value="{{ $user_detail->birth_date }}"></div>
                            <div class="col-md-6"><label class="labels">Image</label><input type="file"
                                    class="form-control" name="image" placeholder="enter Image" value=""></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Address</label><input type="text"
                                    class="form-control" name="address" placeholder="enter address" value="{{ $user_detail->address }}"></div>
                            <div class="col-md-6"><label class="labels">City</label><input type="text"
                                    class="form-control" name="city" placeholder="enter city" value="{{ $user_detail->city }}"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Country</label><input type="text"
                                    class="form-control" name="country" placeholder="enter country" value="{{ $user_detail->country }}"></div>
                            <div class="col-md-6"><label class="labels">Postal Code</label><input type="text"
                                    class="form-control" name="postal_code" placeholder="enter postal code" value="{{ $user_detail->postal_code }}"></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Email ID</label><input type="text"
                                    class="form-control" name="email" placeholder="enter email id" value="{{ $user->email }}"></div>
                        </div>

                        <!-- Your existing code -->

                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save
                                Profile</button></div>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
@endsection
