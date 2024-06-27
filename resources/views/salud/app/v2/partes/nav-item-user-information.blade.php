<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
        <img class="img-profile rounded-circle" src="{{ Auth::user()->adminlte_image() }}">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="userDropdown">
        <x-dropdown-item icon="fas fa-user fa-sm fa-fw" route="{{ route('salud.app.profile')}}">
            Perfil
        </x-dropdown-item>
        <x-dropdown-item icon="fas fa-syringe" route="https://carnetvacunacion.minsa.gob.pe/">
            Vacunas
        </x-dropdown-item>
        <x-dropdown-item icon="fas fa-balance-scale" route="{{ route('salud.app.herramientas') }}">
            Herramientas
        </x-dropdown-item>
        <div class="dropdown-divider"></div>
        {{-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar sesión
        </a> --}}
        <x-dropdown-item icon="fas fa-key" route="{{ route('salud.app.password.edit') }}">
            Cambiar Contraseña
        </x-dropdown-item>
    </div>
</li>