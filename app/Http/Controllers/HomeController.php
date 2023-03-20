<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function Product_Category()
    {
        
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        return view('user.category',compact('products'));
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
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        
        return view('user.cart',compact('carts'));
    }

    public function Add_Cart(Request $req)
    {
        $req->validate([
            'quantity'=>'required'
        ]);

        $product_id=$req->product_id;
        $product_data=Product::find($product_id);
        $user_id=Auth::user()->id;
        $cart=new Cart;
        $cart->product_id=$product_id;
        $cart->user_id=$user_id;
        $cart->quantity=$req->quantity;
        $cart->tot_amount=$req->quantity*$product_data->product_price;
        $cart->save();
        return redirect()->back()->with('success','product has been added to cart!!');
    }
}