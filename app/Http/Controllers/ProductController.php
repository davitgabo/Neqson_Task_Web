<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product',[
            'categories'=>Category::all(),
            'subcategories'=>Subcategory::all(),
            'subsubcategories'=>Subsubcategory::all(),
            'products'=>Product::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'subsubcategory' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'subsubcategory_id' => $request->subsubcategory,
        ]);

        return to_route('product');
    }
}
