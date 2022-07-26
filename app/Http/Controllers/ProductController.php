<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function cartList()
    {
        $userId = Session::get('user')->id;
        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();

        return view('cartlist', ['products' => $products]);
    }

    public function removeCart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect('/cartlist');
    }

    public function orderNow()
    {
        $userId = Session::get('user')->id;
        $price = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        return view('ordernow', ['total' => $price]);
    }

    public function orderPlace(Request $request)
    {
        $userId = Session::get('user')->id;

        $price = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        $allCart = Cart::query()->where('user_id', $userId)->get('product_id');


        foreach ($allCart as $cart) {
            $order = new Order;
            $order->user_id = $userId;
            $order->product_id = $cart->product_id;
            $order->status = 'pending';
            $order->payment_method = $request->payment;
            $order->payment_status = 'pending';
            $order->address = $request->address;
            $order->total = $price;
            $order->save();
        }

        $cart = Cart::where('user_id', $userId)->get();
        foreach ($cart as $c) {
            $c->delete();
        }
        return redirect('/');
    }

    public function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.user_id',$userId)
            ->get();

        return view('myorders',['orders'=>$orders]);
    }
}
