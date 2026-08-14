<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {

    $produto = Product::with('category')->findOrFail($id);


    $categorias = Category::all();

        return view('product', compact('produto', 'categorias'));
    }
}