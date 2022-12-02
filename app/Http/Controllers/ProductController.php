<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // get products and product related categories
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

        return view('admin.product',['categories'=>Category::all(),
                                          'subcategories'=>Subcategory::all(),
                                          'subsubcategories'=>Subsubcategory::all(),
                                          'products'=>$products]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'name'=> 'required',
            'description' => 'required',
            'category' => 'required|exists:categories,id',
            'subcategory' => 'required|exists:subcategories,id',
            'subsubcategory' => 'required|exists:subsubcategories,id',
            'image' => 'required|image',
        ]);

        // create unique image name
        $imageName = time().'.'.$request->image->extension();

        // save uploaded image to public folder
        $request->image->move(public_path('images'), $imageName);

        // save uploaded product to the products table
        Product::create(['name' => $request->name,
                         'description' => $request->description,
                         'category_id' => $request->category,
                         'subcategory_id' => $request->subcategory,
                         'subsubcategory_id' => $request->subsubcategory,
                         'image' => $imageName]
        );

        return to_route('product');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editPath(Request $request)
    {
        // validate request
        $request->validate([
            'id' =>'required|numeric',
            'category' => 'required',
            'subcategory' => 'required',
            'subsubcategory' => 'required',
        ]);


        // get the product
        $product = Product::find($request->id);

        // edit product path
        $product->category_id = $request->category;
        $product->subcategory_id = $request->subcategory;
        $product->subsubcategory_id = $request->subsubcategory;

        // save the record
        $product->save();

        return to_route('product');
    }

    /**
     * delete product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        //get the product by id
        $product = Product::find($id);

        if ($product) {
            // delete main image
            if (file_exists(public_path('/images/' . $product->image))) {
                unlink(public_path('/images/' . $product->image));
            }

            // delete related images from gallery
            $images = Image::where('product_id',$id)->get();
            foreach ($images as $image){
                unlink(public_path('/images/' . $image->source));
            }

            // delete related images from database
            Image::where('product_id',$id)->delete();

            $product->delete();
        }

        return to_route('product');
    }
}
