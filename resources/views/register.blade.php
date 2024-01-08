<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <title>{{ session('title') }}</title> 
</head>

<body>
    <div class="container mt-5">
        @include('header')
        <form class="form" method="POST" action="{{ route("user.register") }}">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="registerName">Name :-</label>
                <input type="text" id="registerName" class="form-control" name="name" placeholder="name"
                    value="{{ old('name') }}" />
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registeremail">email :-</label>
                <input type="email" id="registerName" class="form-control" name="email" placeholder="email"
                    value="{{ old('email') }}" />
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registerpassword">password :-</label>
                <input type="password" id="registerName" class="form-control" name="password" placeholder="password"
                    value="{{ old('password') }}" />
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registermo_no">mo_no :-</label>
                <input type="number" id="registerName" class="form-control" name="mo_no" placeholder="mo_no"
                    value="{{ old('mo_no') }}" />
                @error('mo_no')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-outline mb-4">
                <label class="form-label" for="registermo_no">gender :-</label>&nbsp;&nbsp;&nbsp;
                <input type="radio" id="registerName" value="male" name="gender"
                    placeholder="gender" />male&nbsp;&nbsp;&nbsp;
                <input type="radio" id="registerName" value="female" name="gender" placeholder="gender" />female
                @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
        </form>
    </div>
    </div>
    <!-- Pills content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
