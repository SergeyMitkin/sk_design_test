<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index() {

        $groups = Groups::all();
        $products = Products::all();

//        $products['tv'] = ['Телевизор 1', 'Телевизор 2', 'Телевизор 3'];
//        $products['dvd'] = ['DVD 1', 'DVD 2', 'DVD 3'];

        return view('index', [
            'groups' => $groups,
            'dvd' => ['DVD 1', 'DVD 2', 'DVD 3']
        ]);
    }
}
