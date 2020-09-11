<?php

namespace App\Http\Controllers\Subcategories;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UpdateSubcategoryController extends Controller
{
    public function __invoke(Request $request, Subcategory $subcategory)
    {
        $subcategory->name = $request->name;
        $subcategory->save();

        Alert::success('¡Subcategoría actualizada!');
        return redirect()->route('subcategories.index');
    }
}
