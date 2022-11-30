<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // get categories that are not empty
        $categories = DB::table('products')
            ->select('categories.name as name','categories.id as id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->distinct()->get();

        return view('public.index',['categories'=>$categories]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        // get subcategories that are not empty
        $subcategories = DB::table('products')
            ->select('subcategories.name as name','subcategories.id as id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
            ->where('products.category_id','=',$id)
            ->distinct()->get();

        return view('public.categories',['categories'=>$subcategories]);
    }

    /**
     * @param $id1
     * @param $id2
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lastLayer($id1, $id2)
    {
        // get the last layer of subcategories that are not empty
        $subcategories = DB::table('products')
            ->select('subsubcategories.name as name','subsubcategories.id as id')
            ->leftJoin('categories','products.category_id','=','categories.id')
            ->leftJoin('subcategories','products.subcategory_id','=','subcategories.id')
            ->leftJoin('subsubcategories','products.subsubcategory_id','=','subsubcategories.id')
            ->where('products.category_id','=',$id1)
            ->where('products.subcategory_id','=',$id2)
            ->distinct()->get();

        return view('public.categories',['categories'=>$subcategories]);
    }

    /**
     * @param $id1
     * @param $id2
     * @param $id3
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function products($id1, $id2, $id3)
    {
        // get products from specified categories
        $products = DB::table('products')
            ->select('products.name','products.id','products.image')
            ->where('products.category_id','=',$id1)
            ->where('products.subcategory_id','=',$id2)
            ->where('products.subsubcategory_id','=',$id3)
            ->get();

        return view('public.products',['products'=>$products]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function gallery($id)
    {
        // get product images
        $images = Image::Where('product_id',$id)->get();

        return view('public.product',['images'=>$images]);
    }
}
