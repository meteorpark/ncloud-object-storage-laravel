<?php


namespace Meteopark\Providers;

use Illuminate\Support\ServiceProvider;

class NcloudObjectStorageProvider extends ServiceProvider
{
    public function register()
    {
    }


    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ncloud-object-storage-config.php' => config_path('ncloud-object-storage-config.php')
        ], 'config');
    }
}
