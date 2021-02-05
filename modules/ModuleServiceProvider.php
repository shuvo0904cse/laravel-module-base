<?php
namespace Modules;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Boot
     *
     * Routes Load
     * Views Load
     */
    public function boot()
    {
        $modules = config("modules");

        foreach ($modules as $module) {
            $routeDirectory = __DIR__ . '/' . $module['folder_name'] . '/routes/' . $module['file_name'] . "_routes.php";
            if (file_exists($routeDirectory)) include $routeDirectory;

            $viewDirectory = __DIR__ . '/' . $module['folder_name'] . '/views';
            if (is_dir($viewDirectory)) $this->loadViewsFrom( $viewDirectory, $module['file_name'] );
        }
    }

    /**
     * Register
     */
    public function register()
    {

    }
}