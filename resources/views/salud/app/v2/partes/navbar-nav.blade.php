<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    @include('salud.app.v2.partes.sidebarbrand')
    <!-- Divider -->
    <x-sidebard-divider/>
    <!-- Nav Item - Dashboard -->
    <x-nav-item icon="fas fa-home" route="{{ route('salud.app.index') }}">
        Inicio
    </x-nav-item>
    <!-- Divider -->
    <x-sidebard-divider/>
    <!-- Heading -->
    <x-sidebar-heading>
        Enfermeria
    </x-sidebar-heading>
    <x-nav-item icon="fas fa-user-md" route="{{ route('salud.app.index') }}">
        Atenciones
    </x-nav-item>
    <x-sidebard-divider/>
    <x-sidebar-heading>
        Psicologia
    </x-sidebar-heading>
    <x-nav-item icon="fas fa-brain" route="{{ route('salud.app.index') }}">
        Auto Test
    </x-nav-item>
    <x-sidebard-divider/>
    <x-sidebar-heading>
        Laboratorio
    </x-sidebar-heading>
    <x-nav-item icon="fas fa-vial" route="{{ route('salud.app.index') }}">
        Resultados
    </x-nav-item>
    <x-sidebard-divider/>
    <x-sidebar-heading>
        Ayúdanos
    </x-sidebar-heading>
    <x-nav-item icon="fas fa-hands-helping" route="{{ route('salud.app.index') }}">
        Encuestas
    </x-nav-item>
</ul>