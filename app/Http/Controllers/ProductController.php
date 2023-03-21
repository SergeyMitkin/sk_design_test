<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $groups_model = new Groups();
        $id_group = (\request('group')) ? \request('group') : 0;

        $groups = Groups::where('id_parent', 0)
            ->with('products')
            ->with('children')
            ->get();

        $products = $groups_model->groupProducts($id_group);
        $siblingsIds = $groups_model->siblingsIds($id_group);

        return view('index', [
            'id_group' => $id_group,
            'siblingsIds' => $siblingsIds,
            'groups' => $groups,
            'products' => $products
        ]);
    }
}
