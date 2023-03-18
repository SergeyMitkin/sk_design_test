<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Products::class, 'id_group');
    }

    public function groups()
    {
        return $this->hasMany(Groups::class, 'id_parent');
    }

    public function subgroups()
    {
        return $this->hasMany(Groups::class, 'id_parent')->with('groups');
    }

    public function groupProductsCount()
    {
        // Найти id всех подкатегорий
        $groupIds = [];
        $groupIds[] = $this->id;
        $childrenIds = $this->groupIds($this->id);
        $groupIds = array_merge($groupIds, $childrenIds);

        $productsCount = Products::query()->whereIn('id_group', $groupIds)->get()->count();
        return $productsCount;
    }

    private function groupIds($group_id, $groupIds = [])
    {
        $sql_result = $this->select('id')
            ->where('id_parent', $group_id)
            ->get();

        foreach ($sql_result as $id) {
            $groupIds[] = $id->id;

            $item_result = $this->select('id')
                ->where('id_parent', $id->id)
                ->get();
            if ($item_result->count() > 0) {
                $groupIds = $this->groupIds($id->id, $groupIds);
            }
        }

        return $groupIds;
    }
}
