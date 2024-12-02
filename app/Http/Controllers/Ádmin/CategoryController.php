<?php

namespace App\Http\Controllers\Ádmin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::latest()->get();
        return view('admin.backend.category.all_category',compact('categories'));
    }
}
