<?php

namespace Snssystem\LaravelModuleGenerator;

use Illuminate\Support\ServiceProvider;
use Snssystem\LaravelModuleGenerator\Console\Commands\GenerateModule;
use Snssystem\LaravelModuleGenerator\Console\Commands\ModuleController;
use Snssystem\LaravelModuleGenerator\Console\Commands\ModuleViews;

class ModuleGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->commands([
            GenerateModule::class,
            ModuleController::class,
            ModuleViews::class,
        ]);
    }

    public function register()
    {

    }
}
