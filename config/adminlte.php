<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => '',
    'title_prefix' => 'SISGE Perú Japón | ',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>SISGE-PJ</b> | Principal',
    'logo_img' => 'img/logo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => true,
    'layout_dark_mode' => false,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'inicio',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => false,
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        [
            'text' => 'Administrador',
            'icon' => 'fas fa-users-cog',
            'route' => 'administrador.index',
            'can'=>'administrador.index',
        ],
        [
            'text'    => 'Accesos',
            'icon'    => 'fab fa-galactic-republic',
            'icon_color'=>'info',
            'can'     => 'accesos.permisos.index',
            'submenu' => [
                [
                    'icon'    => 'fas fa-user-tie',
                    'text' => 'Usuarios',
                    'url'  => 'accesos/usuarios',
                    'icon_color' => 'danger'
                ],
                [
                    'icon'=>'fas fa-user-graduate',
                    'text'=>'Estudiantes',
                    'route'=>'accesos.estudiantes.index',
                    'icon_color'=>'primary'
                ],
                [
                    'icon'    => 'fas fa-building',
                    'text' => 'Oficinas',
                    'url'  => 'accesos/oficinas',
                ],
                [
                    'icon'    => 'fas fa-terminal',
                    'text' => 'Permisos',
                    'url'  => 'accesos/permisos',
                ],
                [
                    'icon'    => 'fas fa-suitcase-rolling',
                    'text' => 'Roles',
                    'url'  => 'accesos/roles',
                ],
            ],
        ],
        [
            'text'    => 'Admisiones',
            'icon'    => 'fab fa-galactic-republic',
            'can'   => 'admisiones.reportes.index',
            'submenu' => [
                [
                    'icon'    => 'far fa-user',
                    'text' => 'Postulantes',
                    'url'  => 'admisiones/postulantes',
                    'can'=>'admisiones.postulantes.index'
                ],
                [
                    'icon'=>'fas fa-microchip',
                    'text'=>'Configuracion',
                    'url'=>'admisiones/configuraciones',
                    'can'=>'admisiones.configuraciones.index'
                ],
                [
                    'icon'=>'fas fa-cubes',
                    'text'=>'Eva. Ordinaria',
                    'url'=>'admisiones/ordinarios',
                    'can'=>'admisiones.ordinarios.index'
                ],
                [
                    'icon'=>'fas fa-dungeon',
                    'text'=>'Estudiantes',
                    'url'=>'admisiones/estudiantes',
                    'can'=>'admisiones.estudiantes.index'
                ],
                [
                    'icon'    => 'fas fa-eye',
                    'text' => 'Reportes',
                    'url'  => 'admisiones/reportes',
                    'can'=>'admisiones.reportes.index'
                ],
            ],
        ],
        [
            'text'    => 'Cepres',
            'icon'    => 'fas fa-graduation-cap',
            'can'     => 'cepres.estudiantes.index', 
            'submenu' => [
                [
                    'icon'    => 'fas fa-cash-register',
                    'text' => 'Estudiantes',
                    'url'  => 'cepres/estudiantes',
                ],
                [
                    'icon'=>'fas fa-user-tag',
                    'text'=>'Reg. Asistencia',
                    'route'=>'cepres.estudiantes.asistencias.index'
                ],
                [
                    'icon'    => 'fab fa-amazon-pay',
                    'text' => 'Pagos',
                    'url'  => 'cepres/pagos',
                ],
                [
                    'icon'    => 'fas fa-id-card',
                    'text' => 'Carnets',
                    'url'  => 'cepres/carnets',
                ],
                [
                    'icon'    => 'fas fa-eye',
                    'text' => 'Reportes',
                    'url'  => 'cepres/reportes',
                ],
                [
                    'icon'    => 'fas fa-search-dollar',
                    'text' => 'Cruce Pagos',
                    'url'  => 'cepres/cruzes',
                ],
                [
                    'icon'    => 'far fa-file-alt',
                    'text' => 'Sumativos',
                    'submenu' =>[
                        [
                            'icon' => 'fas fa-cogs',
                            'text' => 'Configuracion',
                            'url'  => 'cepres/sumativos/configuraciones',
                        ],
                        [
                            'icon' => 'fas fa-notes-medical',
                            'text' => 'Calificar',
                            'url'  => 'cepres/sumativos/calificaciones',
                        ],
                        [
                            'icon' => 'fas fa-location-arrow',
                            'text' => 'Consolidar',
                            'url' => 'cepres/sumativos/consolidados'
                        ],
                    ],
                ],
            ],
        ],
        [
            'text'=>'Docentes',
            'icon'=>'fas fa-user-tie',
            'can'=>'docentes.cvs.index',
            'icon_color'=>'success',
            'submenu'=>[
                [
                    'text'=>'Hoja de vida',
                    'icon'=>'far fa-sticky-note',
                    'icon_color'=>'warning',
                    'route'=>'docentes.cvs.index'
                ],
                [
                    'text'=>'Uni. Didácticas',
                    'icon'=>'fas fa-book-reader',
                    'icon_color'=>'info',
                    'submenu'=>[
                        [
                            'text'=>'Regulares',
                            'icon'=>'fas fa-arrow-right',
                            'icon_color'=>'info',
                            'can'=>'docentes.cursos.index',
                            'route'=>'docentes.cursos.index'
                        ],
                        [
                            'text'=>'Extraordinarios',
                            'icon'=>'fas fa-arrow-right',
                            'icon_color'=>'info',
                            'url'=>'#'
                        ]
                    ]
                ]
            ]
        ],
        [
            'text'=>'Sec. Académica',
            'icon'=>'fas fa-user-graduate',
            'icon_color'=>'primary',
            'can'=>'sacademica.estadisticas.index',
            'submenu'=>[
                [
                    'text'=>'Planificación',
                    'icon'=>'fas fa-book',
                    'icon_color'=>'primary',
                    'submenu'=>[
                        [
                            'text'=>'Asignar U. Didacticas',
                            'icon'=>'far fa-square',
                            'route'=>'sacademica.uasignadas.index',
                            'can'=>'sacademica.uasignadas.index',
                            'icon_color'=>'primary',
                        ],
                        [
                            'text'=>'Itinearios Formativos',
                            'icon'=>'far fa-square',
                            'url'=>'sacademica/iformativos',
                            'can'=>'sacademica.iformativos.index',
                            'icon_color'=>'primary',
                        ],
                        [
                            'text'=>'Modulos Formativos',
                            'icon'=>'far fa-square',
                            'url'=>'sacademica/mformativos',
                            'can'=>'sacademica.mformativos.index',
                            'icon_color'=>'primary',
                        ],
                        [
                            'text'=>'Equivalencias',
                            'icon'=>'far fa-square',
                            'route'=>'sacademica.equivalencias.index',
                            'icon_color'=>'primary',
                        ],
                        [
                            'text'=>'Periodos',
                            'icon'=>'far fa-square',
                            'url'=>'sacademica/pmatriculas',
                            'can'=>'sacademica.pmatriculas.index',
                            'icon_color'=>'primary',
                        ],
                    ]
                ],
                /* [
                    'text'=>'Matrículas',
                    'icon'=>'fas fa-book-reader',
                    
                ], */
                [
                    'text'=>'Matrículas',
                    'icon'=>'fas fa-book-reader',
                    'icon_color'=>'warning',
                    'submenu'=>[
                        [
                            'text'=>'Reg. Matrícula',
                            'icon'=>'far fa-circle',
                            'route'=>'sacademica.matriculas.index',
                            'icon_color'=>'warning',
                            'can'=>'sacademica.matriculas.index'
                        ],
                        [
                            'text'=>'Licencias',
                            'icon'=>'far fa-circle',
                            'icon_color'=>'warning',
                            'route'=>'sacademica.licencias.index'
                        ],
                        [
                            'text'=>'Reingresos',
                            'icon'=>'far fa-circle',
                            'icon_color'=>'warning',
                            'route'=>'sacademica.reingresos.index'
                        ],
                        [
                            'text'=>'Moodle',
                            'icon'=>'far fa-circle',
                            'url'=>'sacademica/moodle',
                            'icon_color'=>'warning',
                            'can'=>'sacademica.moodle.index'
                        ],
                        [
                            'text'=>'Nóminas',
                            'icon'=>'far fa-circle',
                            'icon_color'=>'warning',
                            'url'=>'sacademica/nominas',
                        ],
                        [
                            'text'=>'Estadisticas',
                            'icon'=>'far fa-chart-bar',
                            'url'=>'sacademica/estadisticas',
                            'icon_color'=>'warning',
                            'can'=>'sacademica.estadisticas.index'
                        ]
                    ]
                ],
                [
                    'text'=>'Evaluaciones',
                    'icon'=>'fas fa-clipboard-list',
                    'icon_color'=>'danger',
                    'submenu'=>[
                        [
                            'text'=>'Convalidaciones',
                            'icon'=>'far fa-star',
                            'url'=>'sacademica/convalidaciones',
                            'icon_color'=>'danger',
                            'can'=>'sacademica.convalidaciones.index'
                        ],
                        [
                            'text'=>'Regu - Extraordinario',
                            'icon'=>'far fa-star',
                            'url'=>'sacademica/regularizaciones',
                            'icon_color'=>'danger',
                            'can'=>'sacademica.regularizaciones.index'
                        ],
                        [
                            'text'=>'Exp. Formativas',
                            'icon'=>'far fa-star',
                            'route'=>'sacademica.practicas.index',
                            'icon_color'=>'danger',
                            'can'=>'sacademica.practicas.index'
                        ]
                    ]
                ],
                [
                    'text'=>'Estudiantes',
                    'icon'=>'fas fa-user-friends',
                    'icon_color'=>'info',
                    'url'=>'sacademica/estudiantes',
                    'can'=>'sacademica.estudiantes.index'
                ],
               /*  [
                    'text'=>'Exp. Formativas',
                    'icon'=>'fas fa-business-time',
                    'route'=>'sacademica.practicas.index',
                    'can'=>'sacademica.practicas.index'
                ], */
                
                /* [
                    'text'=>'Nominas',
                    'icon'=>'far fa-list-alt',
                    'url'=>'sacademica/nominas'
                ], */
                /* [
                    'text'=>'Convalidaciones',
                    'icon'=>'far fa-map',
                    'url'=>'sacademica/convalidaciones',
                    'can'=>'sacademica.convalidaciones.index'
                ], */
                /* [
                    'text'=>'Regu - Extraordinario',
                    'icon'=>'far fa-clipboard',
                    'url'=>'sacademica/regularizaciones',
                    'can'=>'sacademica.regularizaciones.index'
                ], */
                /* [
                    'text'=>'Verificaciones',
                    'icon'=>'fas fa-spell-check',
                    'url'=>'sacademica/verificaciones',
                    'can'=>'sacademica.verificaciones.index'
                ], */
                /* [
                    'text'=>'Verificaciones Avanzado',
                    'icon'=>'fas fa-spell-check',
                    'url'=>'sacademica/verificacionesas'
                ], */
                /* [
                    'text'=>'Moodle',
                    'icon'=>'fas fa-brain',
                    'url'=>'sacademica/moodle',
                    'can'=>'sacademica.moodle.index'
                ], */
                /* [
                    'text'=>'Estadisticas',
                    'icon'=>'far fa-chart-bar',
                    'url'=>'sacademica/estadisticas',
                    'can'=>'sacademica.estadisticas.index'
                ] */
            ]
        ],
        [
            'text'=>'Salud',
            'icon'=>'fas fa-hospital-user',
            'can'=>'salud.acampanias.index',
            'submenu'=>[
                [
                    'text'=>'Atenciones Campañas',
                    'icon'=>'fas fa-thumbtack',
                    'route'=>'salud.acampanias.index',
                    'can'=>'salud.acampanias.index'
                ],
                [
                    'text'=>'Campañas',
                    'icon'=>'fas fa-stethoscope',
                    'route'=>'salud.campanias.index',
                    'can'=>'salud.campanias.index'
                ],
                [
                    'text'=>'Encuestas',
                    'icon'=>'far fa-chart-bar',
                    'route'=>'salud.encuestas.index',
                    'can'=>'salud.encuestas.index'
                ]
            ],
        ],
        [
            'text'=>'Trámite Documentario',
            'icon'=>'far fa-file',
            'can'=>'tdocumentario.index',
            'icon_color'=>'info',
            'submenu'=>[
                [
                    'text'=>'Mesa de Partes',
                    'icon'=>'fas fa-check-double',
                    'can'=>'tdocumentario.mesapartes.index',
                    'url'=>'tdocumentario/mesapartes'
                ],
                [
                    'text'=>'Recibidos',
                    'icon'=>'far fa-envelope',
                    'url'=>'tdocumentario/rdocumentos'
                ],
                [
                    'text'=>'Enviados',
                    'icon'=>'fas fa-paper-plane',
                    'url'=>'tdocumentario/edocumentos'
                ],
                [
                    'text'=>'Finalizados',
                    'icon'=>'fas fa-stamp',
                    'url'=>'tdocumentario/fdocumentos'
                ],
                [
                    'text'=>'Archivados',
                    'icon'=>'fas fa-check-double',
                    'url'=>'tdocumentario/adocumentos'
                ]
            ]
        ],
        [
            'text'    => 'Administración',
            'icon'    => 'fab fa-sellsy',
            'can'     => 'ventas.clientes.index',
            'icon_color'=>'danger',
            'submenu' => [
                [
                    'icon'    => 'fab fa-servicestack',
                    'text' => 'Servicios',
                    'route'=>'ventas.servicios.index',
                    'icon_color'=>'danger'
                ],
                [
                    'icon'    => 'fas fa-users',
                    'text' => 'Clientes',
                    'route'=>'ventas.clientes.index',
                    'icon_color'=>'danger'
                ],
                [
                    'icon'    => 'fab fa-sellcast',
                    'text' => 'Ventas',
                    'route'=>'ventas.ventas.index',
                    'icon_color'=>'danger'
                ],
                [
                    'icon'    => 'fas fa-money-bill-alt',
                    'text' => 'Deudas',
                    'route'=>'ventas.deudas.index',
                    'icon_color'=>'danger'
                ],
                [
                    'text'=>'Reportes',
                    'icon'=>'fas fa-chart-line',
                    'route'=>'ventas.reportes.index',
                    'icon_color'=>'danger'
                ],
                /* [
                    'text'=>'Matricula Rapida',
                    'icon'=>'fas fa-shipping-fast',
                    'route'=>'ventas.vmatriculas.index'
                ], */
                /* [
                    'text'=>'Aperturas',
                    'icon'=>'fas fa-lock-open',
                    'can'=>'ventas.aperturas.index',
                    'route'=>'ventas.aperturas.index'
                ] */
            ],
        ],
        [
            'text'=>'Estudiante',
            'icon'=>'fas fa-user-graduate',
            'icon_color'=>'info',
            'can'=>'dashboard.postulaciones.index',
            'submenu'=>[
                [
                    'text'=>'Perfil',
                    'icon'=>'fas fa-id-card',
                    'icon_color'=>'info',
                    'route'=>'estudiantes.perfile.index'
                ],
                [
                    'text'=>'Matriculas',
                    'icon'=>'fas fa-list',
                    'icon_color'=>'info',
                    'route'=>'estudiantes.matriculas.index'
                ],
                [
                    'text'=>'Reportes',
                    'icon'=>'fas fa-print',
                    'icon_color'=>'success',
                    'submenu'=>[
                        [
                            'text'=>'Notas',
                            'icon'=>'fas fa-sort-numeric-up-alt',
                            'icon_color'=>'success',
                            'route'=>'estudiantes.reportenotas.index',
                        ]
                    ]
                ],
                [
                    'text'=>'Servicios',
                    'icon'=>'fas fa-th',
                    'icon_color'=>'danger',
                    'submenu'=>[
                        [
                            'text'=>'Biblioteca',
                            'icon'=>'fas fa-book-open',
                            'icon_color'=>'danger',
                            'url'=>'https://biblioteca.idexperujapon.edu.pe',
                        ],
                        [
                            'text'=>'Bolsa Laboral',
                            'icon'=>'fas fa-building',
                            'icon_color'=>'danger',
                            'url'=>'https://empleabilidad.idexperujapon.edu.pe',
                        ]
                    ]
                ]
            ]
        ],
        /* [
            'text'=>'Estadisticas',
            'icon'=>'far fa-chart-bar',
            'submenu'=>[
                [
                    'text'=>'Inicio',
                    'icon'=>'far fa-circle',
                    'route'=>'statistics.website',
                ]
            ]
        ], */
        /* ['header' => 'OTROS'],
        [
            'text'       => 'Repositorio',
            'icon_color' => 'cyan',
            'url'        => 'repositorios',
            'can'        => 'repositorios.index'
        ], */
        /* [
            'text'  => 'Soporte',
            'icon'  => 'fas fa-headset',
            'submenu' =>[
                [
                    'text'  => 'Carlos Santillan',
                    'url'   => 'https://wa.link/3arb5f',
                    'icon'  => 'fab fa-whatsapp',
                    'target' => '_blank',
                ],
                [
                    'text'  => 'Davis Aparicio',
                    'url'   => 'https://wa.link/c87xqx',
                    'icon'  => 'fab fa-whatsapp',
                    'target' => '_blank',
                ],
            ]
        ],    */ 
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Google' =>[
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//google.com/recaptcha/api.js',
                ],
            ],
        ],
        'bootstrapSlider'=>[
            'active'=>true,
            'files'=>[
                [
                    'type'=>'css',
                    'asset'=>true,
                    'location'=>'/vendor/bootstrap-slider/css/bootstrap-slider.min.css'
                ],
                [
                    'type'=>'js',
                    'asset'=>true,
                    'location'=>'/vendor/bootstrap-slider/bootstrap-slider.min.js'
                ]
            ],
        ],
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],

        'bootstrap-select' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/snapappointments/bootstrap-select/dist/css/bootstrap-select.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/snapappointments/bootstrap-select/dist/js/bootstrap-select.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/snapappointments/bootstrap-select/dist/js/i18n/defaults-es_ES.js',
                ],
            ],
        ],

        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Personal' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/js/main.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
