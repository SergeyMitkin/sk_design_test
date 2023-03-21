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

    public function parent()
    {
        return $this->hasOne(Groups::class, 'id', 'id_parent');
    }

    public function idParentById($group_id)
    {
        $sql_result = $this->select('id_parent')
            ->where('id', $group_id)
            ->sole()
        ;

        return $sql_result->id_parent;
    }

    public function siblingsBefore($index)
    {

        return 'before';
        // --- ОТЛАДКА НАЧАЛО
//        echo '<pre>';
//        var_dump($this->parent->children[0]->id);
//        echo'</pre>';
//        die;
        // --- Отладка конец
    }

    public function groupProducts()
    {
        // Найти id всех подкатегорий
        $groupIds = [];
        $groupIds[] = $this->id;
        $childrenIds = $this->childrenIds();
        $groupIds = array_merge($groupIds, $childrenIds);

        $products = Products::query()->whereIn('id_group', $groupIds)->get();
        return $products;
    }

    /**
     * Массив с id всех потомков группы
     * @param $group_id
     * @param $groupIds
     * @return array|mixed
     */
    public function childrenIds($id_group = false, $childrenIds = [])
    {
        $id_group = ($id_group) ? $id_group : $this->id;
        $sql_result = $this->select('id')
            ->where('id_parent', $id_group)
            ->get();

        foreach ($sql_result as $item) {
            $childrenIds[] = $item->id;

            $item_result = $this->select('id')
                ->where('id_parent', $item->id)
                ->get();

            if ($item_result->count() > 0) {
                $childrenIds = $this->childrenIds($item->id, $childrenIds);
            }
        }

        return $childrenIds;
    }

    public function siblingsIds($id_group = false, $siblingIds = []) {

        $id_group = ($id_group) ? $id_group : $this->id;

        // Находим id родителя
        $sql_parent = $this->select('id_parent')
            ->where('id', $id_group)
            ->get();

        if ($sql_parent->count() > 0) {
            $sql_parent_child = $this->select('id')
                ->where('id_parent', $sql_parent[0]->id_parent)
                ->get();
            $siblingIds = array_merge($siblingIds, $sql_parent_child->pluck('id')->toArray());
        }

        if ($sql_parent->count() > 0) {

            // Находим прародителя
            $grandparent = $this->select('id_parent')
                ->where('id', $sql_parent[0]->id_parent)
                ->get();

            if($grandparent->count() > 0) {
                // Находим дочерние элементы прародителя
                $sql_grandparent_child = $this->select('id')
                    ->where('id_parent', $grandparent[0]->id_parent)
                    ->get();
                $siblingIds = array_merge($siblingIds, $sql_grandparent_child->pluck('id')->toArray());

                $siblingIds = $this->siblingsIds($grandparent[0]->id_parent, $siblingIds);
            }
        }

        return $siblingIds;
    }
}
