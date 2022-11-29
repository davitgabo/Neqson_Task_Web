<?php

namespace App\Http\Controllers;


use App\Models\image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        return view('gallery',['products'=>Product::all()]);
    }

    public function show($id)
    {
        return view('images',['title'=>Product::find($id)->name,
                                    'images'=>Image::all(),
                                    'id'=>$id]);
    }

    public function store(Request $request)
    {
        $image = $request->file('image');

        $image->getClientOriginalExtension();
    }
}
