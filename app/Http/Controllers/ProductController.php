<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->select(
                'products.name as name',
                'products.description as description',
                'categories.name as category',
                'subcategories.name as subcategory',
                'subsubcategories.name as subsubcategory')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
            ->leftJoin('subsubcategories','products.subsubcategory_id','=','subsubcategories.id')
            ->get();
        return view('product',[
            'categories'=>Category::all(),
            'subcategories'=>Subcategory::all(),
            'subsubcategories'=>Subsubcategory::all(),
            'products'=>$products]);
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
