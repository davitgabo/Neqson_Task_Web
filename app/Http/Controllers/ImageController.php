<?php

namespace App\Http\Controllers;


use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.gallery',['products'=>Product::all()]);
    }

    public function show($id)
    {
        return view('admin.images',['title'=>Product::find($id)->name,
                                    'images'=>Image::where('product_id',$id)->get(),
                                    'id'=>$id]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        Image::create([
                'source' => $imageName,
                'product_id' => $request->id
            ]);

        return to_route('images',['id'=>$request->id]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'image' => 'required'
        ]);

        Image::find($request->id)->delete();
        unlink(public_path('/images/' . $request->image));

        return redirect()->back();
    }

    public function change(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'product_id'=>'required',
        ]);

        $product = Product::find($request->product_id);
        $image = Image::find($request->id);


        $temp = $product->image;
        $product->image = $image->source;
        $image->source = $temp;

        $product->save();
        $image->save();

        return redirect()->back();
    }
}
