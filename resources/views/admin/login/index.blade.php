<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Hidden Markov Models</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/media/image/favicon.png" />
    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/bundle.css" type="text/css">
    <!-- App styles -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/app.min.css" type="text/css">
</head>

<body class="form-membership">

    <!-- begin::preloader-->
    <div class="preloader">
        <div class="preloader-icon"></div>
    </div>
    <!-- end::preloader -->

    <div class="form-wrapper">

        <!-- logo -->
        <div id="logo">
            <img src="{{ asset('admin') }}/assets/media/image/dark-logo.png" alt="image">
        </div>
        <!-- ./ logo -->

        <h5>Sign in</h5>

        @if (session()->has('notifications'))
            <div class="alert alert-danger" role="alert">{{ session('notifications') }}</div>
        @endif

        <!-- form -->
        <form action="{{ url('authenticate') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autofocus>
                @error('email')
                    <small class="text-danger" id="email_error">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                @error('password')
                    <small class="text-danger" id="password_error">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
        </form>
        <!-- ./ form -->

    </div>

    <!-- Plugin scripts -->
    <script src="{{ asset('admin') }}/vendors/bundle.js"></script>
    <!-- App scripts -->
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>
</body>

</html>
