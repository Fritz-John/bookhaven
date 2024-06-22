<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $categoriesModel;

    public function __construct()
    {
        $this->categoriesModel = new Categories();
    }
    public function index()
    {
        return view('categories.index', [
            'categories' => Categories::latest()->get()
        ]);
     
    }


    public function create_category()
    {
        return view('categories.create');
        
    }

    public function store(Request $request)
    {
        $this->categoriesModel->store_category($request);

        return redirect()->route('create-category')->with('success', 'Added new category');
    }

    public function remove_category($category_id)
    {
       $check_status = $this->categoriesModel->delete_category($category_id);
        if($check_status){
            return redirect()->route('all-categories')->with('success', 'Deleted category');
        }else{
            return redirect()->route('all-categories')->with('error', 'Something went wrong!');
        }
      
    }

}
