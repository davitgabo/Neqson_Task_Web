<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @param $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index($page)
    {
        // check which category layer is being requested
        switch($page) {
            case 'category':
                $categories = Category::all();
                break;
            case 'subcategory':
                $categories = Subcategory::all();
                break;
            case 'subsubcategory':
                $categories = Subsubcategory::all();
                break;
            default:
                return redirect()->back();
        }

        return view('admin.category', ['categories' => $categories, 'title' => $page]);

    }

    /**
     * add a new category
     *
     * @param Request $request
     * @param $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $page)
    {
        // validate the request
        $request->validate([
            'name'=> 'required|unique:categories|unique:subcategories|unique:subsubcategories',
        ]);

        // check which category layer is stored and create a record in the relevant table.
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

    /**
     * edit the category record
     *
     * @param Request $request
     * @param $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $page)
    {
        // get the table name from the requested page
        $db = substr($page,0,-1).'ies';

        // validate request
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|unique:categories|unique:subcategories|unique:subsubcategories'
        ]);

        // update the table record
        DB::table($db)->where('id', $request->id)->update(['name'=>$request->name]);

        return to_route('category',['category'=>$page]);
    }

    /**
     * delete the category record
     *
     * @param Request $request
     * @param $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($page, $id)
    {
        // get the table name from the requested page
        $db = substr($page,0,-1).'ies';

        // delete the table record
        DB::table($db)->where('id', $id)->delete();

        return to_route('category',['category'=>$page]);
    }
}
