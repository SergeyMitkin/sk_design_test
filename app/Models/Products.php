<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function group() {
        return $this->belongsTo(Groups::class, 'id_group');
    }

    public static function getGroupProducts($id_group) {
        // --- ОТЛАДКА НАЧАЛО
        echo '<pre>';
        var_dump(Groups::class);
        echo'</pre>';
        die;
        // --- Отладка конец
    }
}
