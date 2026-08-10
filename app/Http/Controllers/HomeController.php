<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; 

class HomeController extends Controller
{

public function index(Request $request)
    {

    $query = Product::with('category');


    if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }



        $produtos = $query->take(10)->get(); 

        $categorias = Category::all();

        return view('landingpage', compact('produtos', 'categorias'));
    }
}