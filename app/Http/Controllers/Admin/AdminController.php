<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $products = Product::with('productOption','Category')->get();
        return view('admin.index',[
            'categories' => $categories,
            'products' => $products
        ]);
    }

    
}
