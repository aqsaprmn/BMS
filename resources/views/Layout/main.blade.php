<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('') }}assets/images/logo/api.png" type="image/x-icon">

    <title>{{ $title }} - SOP-ALPRO</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    {{-- Vendor --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- <link rel="stylesheet" href="{{ asset('') }}assets/vendors/fontawesome/all.css"> --}}

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/simple-datatables/style.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/datatables/datatables.min.css">

    {{-- <link rel="stylesheet"
        href="{{ asset('') }}assets/vendors/datatables/Select-1.7.0/css/select.dataTables.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/select2/select2.min.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/sweetalert2/sweetalert2.min.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/vendors/croppie/croppie.css">
    {{-- End Vendor --}}

    {{-- Template --}}
    <link rel="stylesheet" href="{{ asset('') }}assets/css/app.css">

    <link rel="stylesheet" href="{{ asset('') }}assets/css/bootstrap.css">
    {{-- End Template --}}

    {{-- My Style --}}
    <link rel="stylesheet" href="{{ asset('') }}assets/css/style.css">
    {{-- End My Style --}}
</head>

<body>
    @include('sweetalert::alert')

    <div id="app" class=" position-relative">

        {{-- Sidebar --}}

        @include('Partial.sidebar')

        {{-- End Sidebar --}}

        <div id="main" style="" class="h-100 p-0 position-relative">
            @include('Partial.topbar')

            <div class="p-4-5">
                <div class="page-heading">
                    @yield('heading')
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
            </div>

            @include('Partial.footer')
        </div>
    </div>

    <script>
        const url = "{{ url('') }}";
    </script>

    <script src="{{ asset('') }}assets/js/extensions/jquery.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/sweetalert2/sweetalert2.all.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="{{ asset('') }}assets/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/apexcharts/apexcharts.js"></script>

    <script src="{{ asset('') }}assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script src="{{ asset('') }}assets/vendors/datatables/datatables.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/select2/select2.min.js"></script>

    <script src="{{ asset('') }}assets/vendors/croppie/croppie.min.js"></script>

    {{-- @isset($script)
        {!! $script !!}
    @endisset --}}

    {{-- <script src="{{ asset('') }}assets/js/admin/common.js"></script> --}}

    <script src="{{ asset('') }}assets/js/main.js"></script>

    <script src='{{ asset('') }}assets/js/admin/datatable.js'></script>

    @stack('scripts')

    @yield('js')


</body>

</html>
