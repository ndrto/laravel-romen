<?php

namespace Ndrto\Romen;

use App\Models\User;
use Auth;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Ndrto\Romen\Models\Menu;

class AuthenticationMenu
{

    protected Collection $menus;

    protected Request $request;

    public function __construct()
    {
        $this->menus = Cache::remember('menus.' . $this->user()->id, Carbon::now()->addHour(), function () {
            return $this->user()->getAllMenus();
        });

        $this->request = request();
    }

    public function check(): bool
    {
        return $this->menus->contains(function ($menu) {
            return $this->request->is(trim($menu->url, '/') . '*');
        });
    }

    public function currentAs(Menu $menu): bool
    {
        return $this->request->is(trim($menu->url, '/') . '*');
    }

    public function getByParent($parent = 0): Collection
    {
        return $this->menus->filter(function (Menu $menu) use ($parent) {
            return $menu->parent == $parent;
        })->sortBy('order');
    }

    protected function user(): ?User
    {
        return Auth::user();
    }

}
