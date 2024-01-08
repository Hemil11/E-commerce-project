<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="">
    <title>{{ session('title') }}</title>
</head>

<body>
    <div>
        <h1 class="d-flex justify-content-center mt-4"><--- Enter New Paasowrd  ---></h1>
        <form class="container" action="{{ route('change.password') }}" method="POST">
            @csrf
            <!-- password  -->
            <div class="form-outline m-4">
                <label class="form-label" for="form2Example1">Password :-</label>
                <input type="number" id="form2Example1" class="form-control" name="password"
                    placeholder="enter password " />
            </div>
            <!-- password  -->
            <div class="form-outline m-4">
                <label class="form-label" for="form2Example1">Confirm password :-</label>
                <input type="number" id="form2Example1" class="form-control" name="confirm_password"
                    placeholder="enter confirm_password " />
                <input type="email" id="form2Example1" class="form-control" name="email" hidden value="{{ $email }}"
                    placeholder="enter confirm_password " />
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
            <button type="submit" class="btn btn-primary btn-block mb-4 btn-s">enter</button>
            {{-- <button type="" class="btn btn-primary mb-4 btn-s">resend</button> --}}

            <!-- Register buttons -->
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Open the modal when the page is loaded
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        window.onload = function() {
            myModal.show();
        };
    </script>
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
