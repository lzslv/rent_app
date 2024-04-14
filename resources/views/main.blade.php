<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <title>RentApp</title>
</head>
<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div>
        <div>
            <p class="h1 text-center">Welcome to RentApp</p>
        </div>

        <div class="btn-group d-flex" role="group" aria-label="Basic example">
            <a type="button" href="{{route('register')}}" class="btn btn-primary me-2">Register</a>
            <a type="button" href="{{route('login')}}" class="btn btn-outline-primary">Login</a>
        </div>
    </div>
</div>
</body>
</html>


