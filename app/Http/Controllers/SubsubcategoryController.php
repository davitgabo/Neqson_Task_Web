<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;

class SubsubcategoryController extends Controller
{
    public function index()
    {
        return view('subsubcategory',['categories'=>Subsubcategory::select('name')->get()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|unique:subsubcategories',
        ]);

        Subsubcategory::create([
            'name' => $request->name
        ]);

        return to_route('subsubcategory');
    }
}
