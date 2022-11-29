<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        return view('public.index',['categories'=>Category::all()]);
    }

    public function show($id)
    {
        $subcategories = DB::table('products')
            ->select('subcategories.name as name','subcategories.id as id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
            ->where('products.category_id','=',$id)
            ->distinct()->get();
        return view('public.subcategories',['subcategories'=>$subcategories]);
    }

    public function lastLayer($id1, $id2)
        {
            $subcategories = DB::table('products')
                ->select('subsubcategories.name as name','subsubcategories.id as id')
                ->leftJoin('categories','products.category_id','=','categories.id')
                ->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
                ->leftJoin('subsubcategories','products.subsubcategory_id','=','subsubcategories.id')
                ->where('products.category_id','=',$id1)
                ->where('products.subcategory_id','=',$id2)
                ->distinct()->get();
            return view('public.subcategories',['subcategories'=>$subcategories]);
        }

    public function products($id1, $id2, $id3)
    {
        $products = DB::table('products')
            ->select('products.name','products.id','products.image')
            ->where('products.category_id','=',$id1)
            ->where('products.subcategory_id','=',$id2)
            ->where('products.subsubcategory_id','=',$id3)
            ->get();

        return view('public.products',['products'=>$products]);
    }
}
