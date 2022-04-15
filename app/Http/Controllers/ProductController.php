<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.index', ['products' => Product::all()]);
    }

    public function shop()
    {
        return view('pages.shop', ['products' => Product::all()]);
    }

    public function distributor(){
        return view('pages.distributor', ['products' => Product::all()]);
    }
}
