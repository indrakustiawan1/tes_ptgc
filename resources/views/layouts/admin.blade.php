<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Tes</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/media/image/favicon.png" />
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/bundle.css" type="text/css">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Daterangepicker -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/datepicker/daterangepicker.css" type="text/css">
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/dataTable/datatables.min.css" type="text/css">
    <!-- Prism -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/prism/prism.css" type="text/css">
    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/css/app.min.css" type="text/css">
    <!-- Main scripts -->
    <script src="{{ asset('admin') }}/vendors/bundle.js"></script>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Loading...</span>
    </div>
    <!-- ./ Preloader -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper">

        <x-header></x-header>

        <!-- Content wrapper -->
        <div class="content-wrapper">

            <x-sidebar></x-sidebar>

            <!-- Content body -->
            <div class="content-body">

                @yield('content')

                <x-footer></x-footer>

            </div>
            <!-- ./ Content body -->
        </div>
        <!-- ./ Content wrapper -->
    </div>
    <!-- ./ Layout wrapper -->

    <!-- Sweet alert -->
    <script src="{{ asset('admin') }}/assets/js/examples/sweet-alert.js"></script>
    <!-- Toast examples -->
    <script src="{{ asset('admin') }}assets/js/examples/toast.js"></script>
    <!-- Daterangepicker -->
    <script src="{{ asset('admin') }}/vendors/datepicker/daterangepicker.js"></script>
    <!-- DataTable -->
    <script src="{{ asset('admin') }}/vendors/dataTable/datatables.min.js"></script>
    <!-- Prism -->
    <script src="{{ asset('admin') }}/vendors/prism/prism.js"></script>
    <!-- App scripts -->
    <script src="{{ asset('admin') }}/assets/js/app.min.js"></script>

    <script>
        toastr.options = {
            timeOut: 3000,
            progressBar: true,
            showMethod: "slideDown",
            hideMethod: "slideUp",
            showDuration: 200,
            hideDuration: 200
        };
    </script>
</body>

</html>
