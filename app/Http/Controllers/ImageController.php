<?php

namespace App\Http\Controllers;


use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * render product gallery
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('admin.images',['title'=>Product::find($id)->name,
                                         'images'=>Image::where('product_id',$id)->get(),
                                         'id'=>$id]
        );
    }

    /**
     * save image to gallery
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate request
        $request->validate([
            'id' => 'required|numeric',
            'image' => 'required|image'
        ]);

        // create unique image name
        $imageName = time().'.'.$request->image->extension();

        // save uploaded image to public folder
        $request->image->move(public_path('images'), $imageName);

        // save image name to the products table
        Image::create([
                'source' => $imageName,
                'product_id' => $request->id
            ]);

        return to_route('images',['id'=>$request->id]);
    }

    /**
     * delete image from gallery
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        //get the image by id
        $image = Image::find($id);

        if ($image) {
            // delete the image from public folder
            if (file_exists(public_path('/images/' . $image->source))) {
                unlink(public_path('/images/' . $image->source));
            }
            $image->delete();
        }

        return redirect()->back();
    }

    /**
     * change main product image
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function change(Request $request)
    {
        // validate request
        $request->validate([
            'id' => 'required|numeric',
            'product_id'=>'required',
        ]);

        // get the product by id
        $product = Product::find($request->product_id);

        // get the image by id
        $image = Image::find($request->id);

        // swap the image and product image sources
        $temp = $product->image;
        $product->image = $image->source;
        $image->source = $temp;

        // save records to table
        $product->save();
        $image->save();

        return redirect()->back();
    }
}
