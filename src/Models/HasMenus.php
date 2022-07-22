<?php

namespace Ndrto\Romen\Models;

use Auth;
use Illuminate\Database\Eloquent\Builder;

trait HasMenus
{

    public function getAllMenus()
    {
        return Menu::whereHas('roles', function (Builder $query) {
            $query->whereIn('id', $this->roles->pluck('id'));
        })->orderBy('order')->get();
    }

}
