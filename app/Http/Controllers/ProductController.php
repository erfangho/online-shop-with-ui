<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = Product::all();
        return view('product', ['products' => $data]);
    }

    public function detail(Request $request, $id)
    {
        $data = Product::find($id);
        return view('detail', ['product' => $data]);
    }
}
