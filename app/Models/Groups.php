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

//    public function groups()
//    {
//        return $this->hasMany(Groups::class, 'id_parent');
//    }

//    public function subgroups()
//    {
//        return $this->hasMany(Groups::class, 'id_parent')->with('groups');
//    }

//    public function groupProductsCount()
//    {
//        $count = $this->groups()->get()
//            ->sum(function ($subgroup){
//                return $subgroup->products()->count();
//            });
//
//        return $count;
//    }
}
