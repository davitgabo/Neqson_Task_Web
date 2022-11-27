<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('subcategory',['categories'=>Subcategory::select('name')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:subcategories',
        ]);

        Subcategory::create([
            'name' => $request->name
        ]);

        return to_route('subcategory');
    }
}
