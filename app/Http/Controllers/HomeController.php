<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; //eu tinha esquecido dessa bosta

class HomeController extends Controller
{
    public function index()
    {
    // Pegar 10 produto aleatorio pra testar
    $produtos = Product::inRandomOrder()->take(10)->get();
        

        return view('landingpage', compact('produtos'));
    }
}