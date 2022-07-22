<?php

namespace Ndrto\Romen;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Ndrto\Romen\Middlewares\VerifyAuthMenu;

class RomenServiceProvider extends ServiceProvider
{

    public function register()
    {

    }

    public function boot()
    {
        $this->offerPublishing();

        $this->router()->aliasMiddleware('auth.menu', VerifyAuthMenu::class);
    }

    protected function offerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/create_menus_table.php.stub' => $this->getMigrationFileName('create_menus_table.php'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../database/seeders/data/roles.json' => database_path('seeders/data/roles.json'),
            __DIR__ . '/../database/seeders/data/menus.json' => database_path('seeders/data/menus.json'),
            __DIR__ . '/../database/seeders/HasJsonFile.php.stub' => database_path('seeders/HasJsonFile.php'),
            __DIR__ . '/../database/seeders/MenuSeeder.php.stub' => database_path('seeders/MenuSeeder.php'),
            __DIR__ . '/../database/seeders/RoleSeeder.php.stub' => database_path('seeders/RoleSeeder.php'),
        ], 'seeders');
    }

    protected function getMigrationFileName($migrationFileName): string
    {
        $timestamp = date('Y_m_d_His');

        $filesystem = $this->app->make(Filesystem::class);

        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $migrationFileName) {
                return $filesystem->glob($path . '*_' . $migrationFileName);
            })
            ->push($this->app->databasePath() . "/migrations/{$timestamp}_{$migrationFileName}")
            ->first();
    }

    protected function router()
    {
        return $this->app->make(Router::class);
    }

}
