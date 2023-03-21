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

    /**
     * Продукты группы и всех дочерних групп
     *
     * @param $id_group
     */
    public function groupProducts($id_group = false)
    {
        $id_group = ($id_group !== false) ? $id_group : $this->id;
        $groupIds = [];
        $groupIds[] = $id_group;
        $childrenIds = $this->childrenIds($id_group);
        $groupIds = array_merge($groupIds, $childrenIds);

        $products = Products::query()->whereIn('id_group', $groupIds)->get();
        return $products;
    }

    /**
     * Id всех дочерних групп
     *
     * @param $id_group
     * @param $childrenIds
     * @return array|mixed
     */
    public function childrenIds($id_group, $childrenIds = [])
    {
        $children = $this->select('id')
            ->where('id_parent', $id_group)
            ->get();

        foreach ($children as $child) {
            $childrenIds[] = $child->id;

            $siblings = $this->select('id')
                ->where('id_parent', $child->id)
                ->get();

            if ($siblings->count() > 0) {
                $childrenIds = $this->childrenIds($child->id, $childrenIds);
            }
        }

        return $childrenIds;
    }

    /**
     * Id соседних групп
     *
     * @param $id_group
     * @param $siblingIds
     * @return array|mixed
     */
    public function siblingsIds($id_group = false, $siblingIds = []) {
        $id_group = ($id_group !== false) ? $id_group : $this->id;

        $parent = $this->select('id_parent')
            ->where('id', $id_group)
            ->get();

        if ($parent->count() > 0) {

            $children = $this->select('id')
                ->where('id_parent', $parent[0]->id_parent)
                ->get();
            $siblingIds = array_merge($siblingIds, $children->pluck('id')->toArray());

            $grandparent = $this->select('id_parent')
                ->where('id', $parent[0]->id_parent)
                ->get();

            if($grandparent->count() > 0) {
                $grandparent_children = $this->select('id')
                    ->where('id_parent', $grandparent[0]->id_parent)
                    ->get();
                $siblingIds = array_merge($siblingIds, $grandparent_children->pluck('id')->toArray());

                $siblingIds = $this->siblingsIds($grandparent[0]->id_parent, $siblingIds);
            }
        }

        return $siblingIds;
    }
}
