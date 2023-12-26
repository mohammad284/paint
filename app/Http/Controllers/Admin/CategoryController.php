<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryType;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function categories(){
        $categories = CategoryType::all();
        return view('dashboard.category.categories',compact('categories'));
    }
    public function addCategory (Request $request){
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        CategoryType::create($data);
        return redirect()->back()->withErrors('added successfully');
    }
    public function updateCategory (Request $request,$cat_id){
        $category = CategoryType::find($cat_id);
        $data = [
            'en' => [
                'name' => $request -> name_en,
            ],
            'de' => [
                'name' => $request -> name_gr,
            ],
        ];
        $category->update($data);
        return redirect()->back()->withErrors('updated successfully');
    }
    public function deleteCategory ($cat_id){
        $category = CategoryType::find($cat_id)->delete();
        return redirect()->back()->withErrors('deleted successfully');
    }
}
