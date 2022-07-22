# Laravel Romen

## What It Does
This package allows you to create dynamic menu with role and permissions.

This package require `spati/laravel-permission`.

Once installed you can do stuff like this:

```bash
composer require ndrto/laravel-romen
```

You should publish the migration and the settings:

```bash
php artisan vendor:publish --provider="Ndrto\Romen\RomenServiceProvider"
```

Then, settings you roles and menus at this path `database/seeders/data`

Run the migrations: After the config have been configured, you can create the tables for this package by running:

```bash
php artisan migrate:fresh --seed
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
