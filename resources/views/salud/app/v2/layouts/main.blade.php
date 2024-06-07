<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('saludapp/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('saludapp/css/sb-admin-2.css')}}" rel="stylesheet">
    @section('styles')
</head>
<body>
    <div id="wrapper">
        <!-- Sidebar -->
        @include('salud.app.v2.partes.navbar-nav')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        @include('salud.app.v2.partes.content-wrapper')        
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('salud.app.v2.partes.logout')





     <!-- Bootstrap core JavaScript-->
     <script src="{{ asset('saludapp/vendor/jquery/jquery.min.js') }}"></script>
     <script src="{{ asset('saludapp/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 
     <!-- Core plugin JavaScript-->
     <script src="{{ asset('saludapp/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
 
     <!-- Custom scripts for all pages-->
     <script src="{{ asset('saludapp/js/sb-admin-2.min.js') }}"></script>
 
     <!-- Page level plugins -->
     <script src="{{ asset('saludapp/vendor/chart.js/Chart.min.js') }}"></script>
 
     <!-- Page level custom scripts -->
     <script src="{{ asset('vendor/chars/highcharts.js') }}"></script>
     <script src="{{ asset('vendor/chars/highcharts-more.js') }}"></script>

     @yield('scripts')
</body>
</html>