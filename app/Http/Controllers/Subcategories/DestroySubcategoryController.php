<?php

namespace App\Http\Controllers\Subcategories;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DestroySubcategoryController extends Controller
{
    public function __invoke(Subcategory $subcategory)
    {
        $subcategory->delete();

        Alert::success('¡Subcategoría eliminada!');
        return redirect()->back();
    }
}
