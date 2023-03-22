<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\ProductImage;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        if(Auth::id())
        {
            if(Auth::user()->usertype=='2')
            {
                return redirect('admin/admin-dashboard');
            }
            elseif(Auth::user()->usertype=='1')
            {
                return redirect('agent-dashboard');
            }
            else
            {
                $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
                return view('user.index',compact('slide_products'));
            }
        }
        else
        {
            $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            return view('user.index',compact('slide_products'));
        }
    }


    public function Check_Product($id)
    {
        $related_products_data=Product::where('product_publish','1')->where('id','!=',$id)->latest()->take(6)->get();
        
        $product=Product::where('product_publish','1')->where('id',$id)->first();

        if($product)
        {
            $imageproduct=ProductImage::latest()->take(3)->get();
        // dd($imageproduct);
            return view('user.product',compact('product','related_products_data','imageproduct'));
        }
        else
        {
            return view('errors.404');
        }
    }

   
    public function ProductCart()
    {
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        
        return view('user.cart',compact('carts','subtotcart'));
    }


    public function Update_Cart(Request $req)
    {

        $cart_id=$req->id;
        $cart=Cart::find($cart_id);
        $cart->quantity=$req->quantity;
        $cart->tot_amount=$req->quantity*$cart->product->product_price;
        $cart->update();

        $carts=Cart::where('user_id',Auth::user()->id)->get();
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

        return response()->json([
            'message'=>'product updated successfully',
            'status'=>200,
            'view'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart')),
            'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart')),
            
        ]);
    }


    public function Product_Category()
    {
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        return view('user.category',compact('products'));
    }

    public function Add_Cart(Request $req)
    {
        
if(Auth::check())
{
    $req->validate([
        'quantity'=>'required'
    ]);

        $product_id=$req->product_id;
        $product_data=Product::find($product_id);
        $user_id=Auth::user()->id;
        $product_exist=Cart::where('product_id','=',$product_id)->where('user_id',$user_id)->get('id')->first();
        if($product_exist)
        {
            $cart=Cart::find($product_exist)->first();
            $quantity=$cart->quantity;
            $cart->quantity=$quantity+$req->quantity;
            $tot=$cart->tot_amount;
            $cart->tot_amount=$tot+($req->quantity*$product_data->product_price);
            $cart->save();

            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            $carts=Cart::where('user_id',Auth::user()->id)->get();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

            return response()->json([
                'status'=>200,
                'message'=>'product has been added to one already in cart!!',
                'view'=>(String)View::make('user.includes.category-products',compact('products')),
                'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart')),

            ]);
        }
        else{
            $cart_data=new Cart;
            $cart_data->product_id=$req->product_id;
            $cart_data->user_id=$user_id;
            $cart_data->quantity=$req->quantity;
            $cart_data->tot_amount=$req->quantity*$product_data->product_price;
            $cart_data->save(); 

            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            $carts=Cart::where('user_id',Auth::user()->id)->get();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

            return response()->json([
                'status'=>200,
                'message'=>'product has been added to cart!!',
                'view'=>(String)View::make('user.includes.category-products',compact('products')),
                'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart')),
            ]);
        }
}
else{

    return response()->json([
        'status'=>401,
        'message'=>'first login to continue!!',
    ]);
}
       
       
    }


}