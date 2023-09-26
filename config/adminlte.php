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
    'usermenu_image' => false,
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

        // Sidebar items:
        /* [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],
      
        ['header' => 'account_settings'],
        [
            'text' => 'profile',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-user',
        ],
        [
            'text' => 'change_password',
            'url'  => 'admin/settings',
            'icon' => 'fas fa-fw fa-lock',
        ], */
        //Menus
        [
            'text'    => 'Accesos',
            'icon'    => 'fab fa-galactic-republic',
            'can'     => 'accesos.permisos.index',
            'submenu' => [
                [
                    'icon'    => 'far fa-user',
                    'text' => 'Usuarios',
                    'url'  => 'accesos/usuarios',
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
            'submenu'=>[
                [
                    'text'=>'Hoja de vida',
                    'icon'=>'far fa-sticky-note',
                    'route'=>'docentes.cvs.index'
                ],
                [
                    'text'=>'Cursos',
                    'icon'=>'fas fa-book-reader',
                    'can'=>'docentes.cursos.index',
                    'route'=>'docentes.cursos.index'
                ]
            ]
        ],
        [
            'text'=>'Sec. Académica',
            'icon'=>'fas fa-user-graduate',
            'can'=>'sacademica.estadisticas.index',
            'submenu'=>[
                [
                    'text'=>'Unidades Didacticas',
                    'icon'=>'fas fa-book',
                    'url'=>'#',
                    'submenu'=>[
                        [
                            'text'=>'Asignar U. Didacticas',
                            'icon'=>'fas fa-book-open',
                            'route'=>'sacademica.uasignadas.index',
                            'can'=>'sacademica.uasignadas.index'
                        ],
                        [
                            'text'=>'Modulos Formativos',
                            'icon'=>'fas fa-shapes',
                            'url'=>'sacademica/mformativos',
                            'can'=>'sacademica.mformativos.index'
                        ],
                        [
                            'text'=>'Equivalencias',
                            'icon'=>'fas fa-equals',
                            'route'=>'sacademica.equivalencias.index',
                        ]
                    ]
                ],
                [
                    'text'=>'Itinearios Formativos',
                    'icon'=>'fas fa-list',
                    'url'=>'sacademica/iformativos',
                    'can'=>'sacademica.iformativos.index'
                ],
                [
                    'text'=>'Estudiantes',
                    'icon'=>'fas fa-user-friends',
                    'url'=>'sacademica/estudiantes',
                    'can'=>'sacademica.estudiantes.index'
                ],
                [
                    'text'=>'Matrículas',
                    'icon'=>'fas fa-book-reader',
                    'url'=>'sacademica/matriculas',
                    'can'=>'sacademica.matriculas.index'
                ],
                [
                    'text'=>'Exp. Formativas',
                    'icon'=>'fas fa-business-time',
                    'route'=>'sacademica.practicas.index',
                ],
                [
                    'text'=>'Periodos',
                    'icon'=>'fas fa-hourglass-end',
                    'url'=>'sacademica/pmatriculas',
                    'can'=>'sacademica.pmatriculas.index'
                ],
                [
                    'text'=>'Nominas',
                    'icon'=>'far fa-list-alt',
                    'url'=>'sacademica/nominas'
                ],
                [
                    'text'=>'Convalidaciones',
                    'icon'=>'far fa-map',
                    'url'=>'sacademica/convalidaciones',
                    'can'=>'sacademica.convalidaciones.index'
                ],
                [
                    'text'=>'Regu - Extraordinario',
                    'icon'=>'far fa-clipboard',
                    'url'=>'sacademica/regularizaciones',
                    'can'=>'sacademica.regularizaciones.index'
                ],
                [
                    'text'=>'Verificaciones',
                    'icon'=>'fas fa-spell-check',
                    'url'=>'sacademica/verificaciones',
                    'can'=>'sacademica.verificaciones.index'
                ],
                /* [
                    'text'=>'Verificaciones Avanzado',
                    'icon'=>'fas fa-spell-check',
                    'url'=>'sacademica/verificacionesas'
                ], */
                [
                    'text'=>'Moodle',
                    'icon'=>'fas fa-brain',
                    'url'=>'sacademica/moodle',
                    'can'=>'sacademica.moodle.index'
                ],
                [
                    'text'=>'Estadisticas',
                    'icon'=>'far fa-chart-bar',
                    'url'=>'sacademica/estadisticas',
                    'can'=>'sacademica.estadisticas.index'
                ]
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
            'text'    => 'Ventas',
            'icon'    => 'fab fa-sellsy',
            'can'     => 'ventas.clientes.index',
            'submenu' => [
                [
                    'icon'    => 'fab fa-servicestack',
                    'text' => 'Servicios',
                    'url'  => 'ventas/servicios',
                ],
                [
                    'icon'    => 'fas fa-users',
                    'text' => 'Clientes',
                    'url'  => 'ventas/clientes',
                ],
                [
                    'icon'    => 'fab fa-sellcast',
                    'text' => 'Ventas',
                    'url'  => 'ventas/ventas',
                ],
                [
                    'icon'    => 'fas fa-money-bill-alt',
                    'text' => 'Deudas',
                    'url'  => 'ventas/deudas',
                ],
                [
                    'text'=>'Reportes',
                    'icon'=>'fas fa-chart-line',
                    'url'=>'ventas/reportes'
                ],
                [
                    'text'=>'Matricula Rapida',
                    'icon'=>'fas fa-shipping-fast',
                    'route'=>'ventas.vmatriculas.index'
                ],
                [
                    'text'=>'Aperturas',
                    'icon'=>'fas fa-lock-open',
                    'can'=>'ventas.aperturas.index',
                    'route'=>'ventas.aperturas.index'
                ]
            ],
        ],
        [
            'text'=>'Estadisticas',
            'icon'=>'far fa-chart-bar',
            'submenu'=>[
                [
                    'text'=>'Inicio',
                    'icon'=>'far fa-circle',
                    'route'=>'statistics.website',
                ]
            ]
        ],
        /* ['header' => 'OTROS'],
        [
            'text'       => 'Repositorio',
            'icon_color' => 'cyan',
            'url'        => 'repositorios',
            'can'        => 'repositorios.index'
        ], */
        [
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
        ],    
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
            'active'=>false,
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
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css',
                ],
            ],
        ],

        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
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

    'livewire' => false,
];
