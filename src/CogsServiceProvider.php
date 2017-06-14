<?php

namespace DeFabr13k\Cogs;

/**
 * Class CogsServiceProvider
 * @package DeFabr13k\Cogs
 * @author Olivier Parent <olivier.parent@arteveldehs.be>
 * @copyright Copyright (c) 2017, Olivier Parent & deFABR13K
 */
class CogsServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\DbBackup::class,
                Console\Commands\DbDrop::class,
                Console\Commands\DbInit::class,
                Console\Commands\DbReset::class,
                Console\Commands\DbRestore::class,
                Console\Commands\DbUser::class,
            ]);
        }
    }
}