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
use App\Models\Category;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


//=========================index=========================

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
                    $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
                    $categories=Category::latest()->take(3)->get();
                    return view('user.index',compact('slide_products','categories','products'));
            }
        }
        else
        {
            $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
            $categories=Category::latest()->take(3)->get();
            return view('user.index',compact('slide_products','categories','products'));
        }
    }

//=========================View Single Product=========================


    public function Check_Product($id)
    {
        $related_products_data=Product::where('product_publish','1')->where('id','!=',$id)->latest()->take(6)->get();
        
        $product=Product::where('product_publish','1')->where('id',$id)->first();

        if($product)
        {
            $imageproduct=ProductImage::latest()->take(3)->get();
        // dd($imageproduct);
            return view('user.single-product',compact('product','related_products_data','imageproduct'));
        }
        else
        {
            return view('errors.404');
        }
    }

//========================= Cart =========================

   
    public function ProductCart()
    {
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
        return view('user.cart',compact('carts','subtotcart'));
    }


//=========================Update Cart =========================



    public function Update_Cart(Request $req)
    {

        $cart_id=$req->id;
        $cart=Cart::find($cart_id);
        $cart->quantity=$req->quantity;
        $cart->tot_amount=$req->quantity*$cart->product->product_price;
        $cart->update();

        $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

        return response()->json([
            'message'=>'product updated successfully',
            'status'=>200,
            'view'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart')),
            'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart')),
            
        ]);
    }

//=========================Page Category =========================


    public function Product_Category()
    {
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        return view('user.category',compact('products'));
    }

//=========================Add to Cart =========================


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
            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

            return response()->json([
                'status'=>200,
                'message'=>'added!! but product has already in cart!',
                'view'=>(String)View::make('user.includes.sort-category',compact('products')),
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
            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');

            return response()->json([
                'status'=>200,
                'message'=>'product has been added to cart!!',
                'view'=>(String)View::make('user.includes.sort-category',compact('products')),
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

//=========================Remove items from in Cart =========================



public function Remove_Cart(Request $req)
{
        $cart_id=$req->cart_id;
        $cart=Cart::find($cart_id);
        $cart->delete();
        
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        return response()->json([
            'status'=>200,
            'warning'=>'product has been removed from cart successfully!!',
            'view'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart')),
            'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart')),
        ]);
        
    }
    
    //=========================Load more products =========================

    public function Load_More_Products(){

        $categories=Category::latest()->take(3)->get();
        $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();

        return response()->json([
            'view'=>(String)View::make('user.includes.load-more',compact('slide_products','categories','products'))
        ],200);
    }

    //=========================Less products =========================
    
    public function Less_Products(){

        $categories=Category::latest()->take(3)->get();
        $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
        
        return response()->json([
            'view'=>(String)View::make('user.includes.load-more',compact('slide_products','categories','products'))
        ],200);
    }
    
    //=========================Sort products by category=========================

    public function Sort_By_Category(Request $req)
    {
        if($req->category_val){
            $products=Category::where('slug',$req->category_val)->latest()->first()->product()->get();
            return response()->json([
                'status'=>200,
                'view'=>(String)View::make('user.includes.sort-category',compact('products')),
            ]);  
        }
        else{
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            return response()->json([
                'status'=>200,
                'view'=>(String)View::make('user.includes.category-products',compact('products')),
            ]);   
        }
    }

    //=========================Reset Sort products by category=========================

    public function Reset_Sort_By_Category(Request $req)
    {
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            return response()->json([
                'status'=>200,
                'view'=>(String)View::make('user.includes.sort-category',compact('products')),
            ]);   
        
    }

}