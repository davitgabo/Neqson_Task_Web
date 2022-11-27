<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category',['categories'=>Category::select('name')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name
        ]);

        return to_route('category');
    }
}
