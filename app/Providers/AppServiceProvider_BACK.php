<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

use function PHPUnit\Framework\once;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //require_once  '/home/idexounk/idex-app/app/Http/Helpers.php';
        $this->app->bind('path.public',function(){
            return'/home/idexounk/sisge.idexperujapon.edu.pe'; 
        });
        require_once  __DIR__ . '/../Http/Helpers.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();
    }
}
