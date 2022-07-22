<?php

namespace Ndrto\Romen\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class Menu extends Model
{

    use HasFactory;

    protected $fillable = [
        'parent',
        'name',
        'title',
        'url',
        'icon',
        'class_icon',
        'order'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
