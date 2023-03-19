<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index() {

        $id_group = (\request('group')) ? \request('group') : 0;
        $groups = Groups::where('id_parent', 0)
            ->with('children')
            ->get();

        $products = Products::all();

        return view('index', [
            'id_group' => $id_group,
            'groups' => $groups,
            'products' => $products
        ]);
    }
}
