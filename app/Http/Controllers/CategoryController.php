<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($page)
    {
        switch($page) {
            case 'category':
                return view('admin.category', ['categories' => Category::all(), 'title' => $page]);
            case 'subcategory':
                return view('admin.category', ['categories' => Subcategory::all(), 'title' => $page]);
            case 'subsubcategory':
                return view('admin.category', ['categories' => Subsubcategory::all(), 'title' => $page]);
            default:
                return redirect()->back();
        }
    }

    public function store(Request $request, $page)
    {
        $request->validate([
            'name'=> 'required|unique:categories',
        ]);

        switch($page) {
            case 'category':
                Category::create([
                    'name' => $request->name
                ]);
                break;
            case 'subcategory':
                Subcategory::create([
                    'name' => $request->name
                ]);
                break;
            case 'subsubcategory':
                Subsubcategory::create([
                    'name' => $request->name
                ]);
                break;
            default:
                return redirect()->back();
        }

        return to_route('category',['category'=>$page]);
    }

    public function edit(Request $request, $page)
    {
        $db = substr($page,0,-1).'ies';

        $request->validate([
            "id" => "required|numeric",
            "name" => "required|unique:$db"
        ]);

        DB::table($db)->where('id', $request->id)->update(['name'=>$request->name]);

        return to_route('category',['category'=>$page]);
    }

    public function delete(Request $request, $page)
    {
        $db = substr($page,0,-1).'ies';
        DB::table($db)->where('id', $request->id)->delete();

        return to_route('category',['category'=>$page]);
    }
}
