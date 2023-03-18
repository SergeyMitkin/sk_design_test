<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index() {

        $id_group = (\request('group')) ? \request('group') : 0;
//        $groups = Groups::where('id_parent', $id_group)->get();
        $groups = Groups::where('id_parent', $id_group)->withCount('products')->get();

        $products = Products::all();
//
//        $groups_model = new Groups();
//        $groups_model->groupProductsCount();

        return view('index', [
            'groups' => $groups,
            'products' => $products
        ]);
    }
}
