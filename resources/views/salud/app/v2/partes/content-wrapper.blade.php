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
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Desarrollado por &copy; Of. Soporte Tecnológico 2024</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>