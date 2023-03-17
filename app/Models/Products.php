<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public static function getGroupProducts($id_group) {
        // --- ОТЛАДКА НАЧАЛО
        echo '<pre>';
        var_dump('test');
        echo'</pre>';
        die;
        // --- Отладка конец
    }
}
