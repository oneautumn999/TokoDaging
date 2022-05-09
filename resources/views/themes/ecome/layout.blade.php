<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <title>Meat Store</title>

    <!-- Fonts -->
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
    rel="stylesheet">
   

    <!-- Icons -->
    <link href="{{asset('themes/ecome/assets/css/nucleo-icons.css')}}" rel="stylesheet">
    <link href="{{asset('themes/ecome/assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="style/main.css" rel="stylesheet" />
    
    <!-- Jquery UI -->
    <link type="text/css"  rel="stylesheet" href="{{asset('themes/ecome/assets/css/jquery-ui.css')}}">

    <!-- Argon CSS -->
    <link type="text/css" rel="stylesheet" href="{{asset('themes/ecome/assets/css/argon-design-system.min.css')}}">

    <!-- Main CSS-->
    <link type="text/css" href="{{asset ('themes/ecome/assets/css/style.css')}}" rel="stylesheet">

    <!-- Optional Plugins-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    {{-- header --}}
    @include('themes.ecome.partials.header')
    {{-- endheader --}}
    <!--SLIDER--->
    @yield('content')
    {{-- endslider --}}

    <!-- Services -->
    @include('themes.ecome.partials.services')
    <!-- End Services -->
    {{-- product --}}
    
    {{-- endproduct --}}

    

    {{-- footer --}}
    @include('themes.ecome.partials.footer')
    {{-- endfooter --}}
    @include('themes.ecome.partials.modals')

    <!-- Core -->
    <script src="{{asset('themes/ecome/assets/js/core/jquery.min.js')}}"></script>
    <script src="{{asset('themes/ecome/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('themes/ecome/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('themes/ecome/assets/js/core/jquery-ui.min.js')}}"></script>
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Optional plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Argon JS -->
    <script src="{{asset('themes/ecome/assets/js/argon-design-system.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('themes/ecome/assets/js/main.js')}}"></script>
    <script src="{{ asset('themes/ecome/assets/js/app.js') }}"></script>
    <script>
        $(".delete").on("click", function () {
            return confirm("Do you want to remove this?");
        });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6256bb8d7b967b11798a8b72/1g0hcp93f';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
  <!--End of Tawk.to Script-->
    <script>
       AOS.init();
    </script>
    <script src="/script/navbar-scroll.js"></script>
</body>


