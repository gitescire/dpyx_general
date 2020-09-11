<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DestroyCategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        $category->delete();
        Alert::success('¡Categoría eliminada!');
        return redirect()->back();
    }
}
