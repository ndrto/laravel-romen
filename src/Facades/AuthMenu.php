<?php

namespace Ndrto\Romen\Facades;

use Illuminate\Support\Facades\Facade;
use Ndrto\Romen\AuthenticationMenu;

class AuthMenu extends Facade
{

    protected static function getFacadeAccessor()
    {
        return AuthenticationMenu::class;
    }

}
