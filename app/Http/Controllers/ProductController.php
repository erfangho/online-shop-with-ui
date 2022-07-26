<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function addToCart(Request $request)
    {
        if($request->session()->has('user')){
            $cart = new Cart;
            $cart->user_id = $request->session()->get('user')->id;
            $cart->product_id = $request->product_id;
            $cart->save();
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId = Session::get('user')->id;
        return Cart::where('user_id', $userId)->count();
    }
}
