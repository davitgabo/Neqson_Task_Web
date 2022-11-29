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
            ->select('products.image as image',
                'products.name as name',
                'products.description as description',
                'products.id as id',
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'subcategory_id' => $request->subcategory,
            'subsubcategory_id' => $request->subsubcategory,
            'image' => $imageName
        ]);

        return to_route('product');
    }


    public function editPath(Request $request)
    {
        $request->validate([
            'id' =>'required|numeric',
            'category' => 'required',
            'subcategory' => 'required',
            'subsubcategory' => 'required',
        ]);

        $product = Product::find($request->id);

        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->subsubcategory_id = $request->subsubcategory;

        $product->save();

        return to_route('product');
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id'=>'required|numeric',
            'image'=>'required'
        ]);


        Product::find($request->id)->delete();
        unlink(public_path('/images/'.$request->image));

        return to_route('product');
    }
}
