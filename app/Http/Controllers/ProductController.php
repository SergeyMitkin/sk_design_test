<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function index() {

        $groups_model = new Groups();
        $id_group = (\request('group')) ? \request('group') : 0;
        $id_parent = ($id_group !== 0) ? $groups_model->idParentById($id_group) : 0;

        $groups = Groups::where('id_parent', 0)
            ->with('children')
            ->get();

        $siblingsIds = $groups_model->siblingsIds($id_group);

        $products = Products::all();

        return view('index', [
            'id_group' => $id_group,
            'id_parent' => $id_parent,
            'siblingsIds' => $siblingsIds,
            'groups' => $groups,
            'products' => $products
        ]);
    }
}
