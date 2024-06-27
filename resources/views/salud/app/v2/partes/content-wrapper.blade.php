<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        @include('salud.app.v2.partes.navbar-navbar-expand')
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            @yield('page-header')
            <!-- Content Row -->
            @yield('page-content')
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    @include('salud.app.v2.partes.sticky-footer')
    <!-- End of Footer -->

</div>