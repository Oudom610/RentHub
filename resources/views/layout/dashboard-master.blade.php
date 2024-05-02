<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="./assets/img/renthubicon.png" />
    <title>RentHub</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Main Styling -->
    {{-- <link href="./assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5" rel="stylesheet" />     --}}
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css') }}?v=1.0.5" rel="stylesheet" />

  </head>

  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @yield('content')
  </body>

    {{-- Include the JavaScript file --}}
    <script src="{{ asset('assets/js/logout-dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/sidenav-dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/form-clear.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</html>