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
    <div>
        <h1 class="d-flex justify-content-center mt-4"><--- login to are website ---></h1>
        <form class="container" action="{{ route('user.login') }}" method="POST">
            @csrf
            <!-- Email input -->
            <div class="form-outline m-4">
                <label class="form-label" for="form2Example1">Email address :-</label>
                <input type="email" id="form2Example1" class="form-control" name="email" />
            </div>

            <!-- Password input -->
            <div class="form-outline m-4">
                <label class="form-label" for="form2Example2">Password :-</label>
                <input type="password" id="form2Example2" class="form-control" name="password" />
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 btn-s justify-center">login</button>
            <div class="btn-toolbar d-flex justify-content-center" role="toolbar"
                aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-block mb-3">Sign in</a>
                </div>
                <div class="btn-group me-2" role="group" aria-label="Second group">
                    <a href="{{ route('forget.password.page') }}" class="btn btn-block mb-3">Forget Password</a>
                </div>
            </div>

            <!-- Register buttons -->
        </form>
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
