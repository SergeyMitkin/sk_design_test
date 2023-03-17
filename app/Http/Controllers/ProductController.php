<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = [];
        $products['tv'] = ['Телевизор 1', 'Телевизор 2', 'Телевизор 3'];
        $products['dvd'] = ['DVD 1', 'DVD 2', 'DVD 3'];

        return view('index', [
            'tv' => ['Телевизор 1', 'Телевизор 2', 'Телевизор 3'],
            'dvd' => ['DVD 1', 'DVD 2', 'DVD 3']
        ]);
    }
}
