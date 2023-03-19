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

    public function children()
    {
        return $this->hasMany(Groups::class, 'id_parent');
    }

    public function groupProductsCount()
    {
        // Найти id всех подкатегорий
        $groupIds = [];
        $groupIds[] = $this->id;
        $childrenIds = $this->groupIds();
        $groupIds = array_merge($groupIds, $childrenIds);

        $productsCount = Products::query()->whereIn('id_group', $groupIds)->get()->count();
        return $productsCount;
    }

    public function groupIds($group_id = false, $groupIds = [])
    {
        $group_id = ($group_id) ? $group_id : $this->id;
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
