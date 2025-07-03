<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Menu extends BaseModel
{
    use HasFactory;
    protected $table = 'web_menus';
    public static $myGlobalVar = null;

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        $roleId = Menu::$myGlobalVar;
        return $this->hasMany(Menu::class, 'parent_id')
            ->leftJoin('web_menu_permissions', function ($join) use ($roleId) {
                $join->on('web_menu_permissions.menu_id', '=', 'web_menus.id')
                    ->where('web_menu_permissions.role_id', '=', $roleId);

            })
            ->where('web_menus.is_active', "Y")
            ->where('web_menu_permissions.permission_id', '>', 0)
            ->select(DB::raw('DISTINCT web_menus.*'))
            ->orderBy('web_menus.menu_srl');

    }
    public function scopeParents($query, $roleId)
    {
        Menu::$myGlobalVar = $roleId;
        return $query->leftJoin('web_menu_permissions', function ($join) use ($roleId) {
            $join->on('web_menus.id', '=', 'web_menu_permissions.menu_id')
                ->where('web_menu_permissions.role_id', '=', $roleId);
        })
            ->whereNull('web_menus.parent_id')
            ->where('web_menu_permissions.permission_id', '>', 0)
            ->where('web_menus.is_active', 'Y')
            ->orderBy('web_menus.menu_srl');


    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function scopeRecursiveChildren($query, $parentIds = [])
    {
        $query->whereIn('parent_id', $parentIds);
        $childrenIds = $query->pluck('id')->toArray();

        if (!empty($childrenIds)) {
            $this->scopeRecursiveChildren($query, $childrenIds);
        }

        return $query;
    }

    public function menuPermissions()
    {
        return $this->hasMany(MenuPermission::class);
    }

    public function getUsersPermittedMenu($roleId)
    {

        $web_menus = DB::table('web_menus')
            ->leftjoin('web_menu_permissions', 'web_menus.id', '=', 'web_menu_permissions.menu_id')
            ->select('web_menus.id')
            ->where('web_menu_permissions.role_id', '=', $roleId)
            ->whereNotNull('web_menus.route')
            ->get();

        return $web_menus;

    }
}
