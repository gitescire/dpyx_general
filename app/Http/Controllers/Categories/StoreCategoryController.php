<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->short_name = $request->short_name;
        $category->save();

        Alert::success('Nueva categoría creada!');
        return redirect()->route('categories.index');
    }
}
