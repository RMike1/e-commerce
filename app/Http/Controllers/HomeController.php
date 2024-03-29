<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cart_Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Currency;
use App\Models\User;

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
                return redirect('agent/products');
            }
            else
            {
                    $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
                    $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
                    $categories=Category::latest()->where('category_status','1')->take(3)->get();
                    return view('user.index',compact('slide_products','categories','products'));
            }
        }
        else
        {
            $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
            $categories=Category::latest()->where('category_status','1')->take(3)->get();
            return view('user.index',compact('slide_products','categories','products'));
        }
    }

//========================= Cart =========================

    public function ProductCart(Request $req)
    {

        $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
        $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        $final_tot=$subtotcart+$shipping_val->value;
        $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
        return view('user.cart',compact('carts','subtotcart','final_tot'));
    }

//=========================Update Cart =========================

    public function Update_Cart(Request $req)
    {

        $cart_id=$req->id;
        $cart=Cart::find($cart_id);
        $cart->quantity=$req->quantity;
        $cart->tot_amount=$req->quantity*$cart->product->product_price;
        $cart->update();

        $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
        $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
        $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
        $final_tot=$subtotcart+$shipping_val->value;

        $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();

        return response()->json([
            'message'=>'product updated successfully',
            'status'=>200,
            'view'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart','final_tot')),
            'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart','final_tot')),
        ]);

    }

//=========================Page Category =========================


    public function Product_Category(Request $req)
    {

        if($req->category_val)
        {
            $products=Category::where('name',$req->category_val)->first()->product()->where('product_publish','1')->paginate(8);
            return view('user.category',compact('products'));
        }
        else{
            $products=Product::where('product_publish','1')->latest()->paginate(8);
            return view('user.category',compact('products'));
        }
    }

//=========================Add to Cart ====== ===================

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
                            'message'=>'already added in your cart!!',
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
            return response()->json([
                'status_message'=>200,
            ]);
        }
        else{
            return response()->json([
                'status_message'=>400,
                'warning_message'=>'first login to add items in your cart!!',
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

        $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
        $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
        $shipping_method=User::where('shipping_id',$user_shipping)->first()->shipping()->first()->shipping_method;
        $final_tot=$subtotcart+$shipping_val->value;

        return response()->json([
            'status'=>200,
            'warning'=>'product has been removed from cart successfully!!',
            'view'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart','final_tot')),
            'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart','final_tot')),
            'order_summary'=>(String)View::make('user.includes.order-summary',compact('carts','subtotcart','final_tot','shipping_method')),
        ]);

}

    //=========================Load more products =========================

    public function Load_More_Products(){

        $categories=Category::latest()->where('category_status','1')->take(3)->get();
        $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
        $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();

        return response()->json([
            'view'=>(String)View::make('user.includes.load-more',compact('slide_products','categories','products'))
        ],200);
    }

    //=========================Less products =========================

    public function Less_Products(){

        $categories=Category::latest()->where('category_status','1')->take(3)->get();
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

    //=========================Search Products=========================

    public function Search_Product(Request $req)
    {
        $products=Product::where('product_name','like','%'.$req->product.'%')->where('product_publish','1')->with('ProductImage')->latest()->paginate(8);
        return view('user.category',compact('products'));
    }

    //=====================Shipping======================

    public function Shipping(Request $req)
    {
            $shipping_id=$req->shipping_val;
            User::where('id',Auth::user()->id)->update(['shipping_id'=>$shipping_id]);

            $user_currency=User::where('id',Auth::user()->id)->first()->currency_id;
            $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
            $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
            $final_tot_a=$subtotcart+$shipping_val->value;
            $currency_value=User::where('currency_id',$user_currency)->first()->currency()->first();

            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();

            if($currency_value->code=='RWF')
            {
                $final_tot=$final_tot_a/$currency_value->normal_val;
                return response()->json([
                    'final_tot'=>number_format($final_tot,2),
                    'currency_val'=>'Frw'
                ],200);
            }
            else{
                $final_tot=$final_tot_a/$currency_value->normal_val;
                return response()->json([
                    'final_tot'=>number_format($final_tot,2),
                ],200);
            }
    }

      //=====================Order By Cash======================

      public function Order_by_Cash(Request $req)
      {
        $is_cart=Cart::where('user_id',Auth::user()->id)->get('id')->first();
        if($is_cart!=null)
        {
            $shipping_method=User::where('id',Auth::user()->id)->first()->shipping()->first()->shipping_method;
            $shipping_id=User::where('id',Auth::user()->id)->first()->id;

            $carts=Cart::where('user_id',Auth::user()->id)->get();
            $tracking_no=Str::random(10);

            foreach($carts as $cart)
            {
              $req->validate([
                  'first_name'=>'required|min:2|max:50',
                  'second_name'=>'required|min:2|max:50',
                  'tracking_no'=>'nullable',
                  'order_id'=>'nullable',
                  'company'=>'nullable',
                  'town'=>'required',
                  'state'=>'required',
                  'street'=>'required',
                  'phone'=>'required',
                  'phone'=>'required',
                  'email'=>'required',
                  'note'=>'nullable',
              ]);
              $shipp_id=User::where('id',Auth::user()->id)->first()->id;

                $order_id=Str::random(8);
                $order=new Order;
                $order->order_id='  -'.$order_id;
                $order->tracking_no='EL-'.$tracking_no;
                $order->first_name=$req->first_name;
                $order->second_name=$req->second_name;
                $order->company=$req->company;
                $order->country=$req->country;
                $order->town=$req->town;
                $order->state=$req->state;
                $order->street=$req->street;
                $order->phone=$req->phone;
                $order->shipping_method=$shipping_method;
                $order->quantity=$cart->quantity;
                $order->email=$req->email;
                $order->tot_amount=$cart->tot_amount;
                $order->note=$req->note;
                $order->payment_method="cash";
                $order->delivery_status="pending";
                $order->payment_status="pending";
                $order->product_id=$cart->product_id;
                $order->user_id=$cart->user_id;
                $order->shipping_id=$shipping_id;
                $order->save();

                $cart_id=$cart->id;
                if($cart_id)
                {
                    $cart_data=Cart::find($cart_id);
                    $cart_data->delete();
                }
                else{
                    return redirect()->back();
                }
                $free_shipping=Shipping::where('value','0')->first()->id;
                User::where('id',Auth::user()->id)->update(['shipping_id'=>$free_shipping]);
              }
              return redirect()->back()->with('success','your order has been created successfully!');
            }
            return redirect()->back()->with('warning','your cart is empty! please add products in cart to proceed your order!!');
      }

    //=========================Checkout page============================

      public function Checkout(Request $req)
      {
            $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
            $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
            $shipping_method=User::where('shipping_id',$user_shipping)->first()->shipping()->first()->shipping_method;
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val->value;
            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
            return view('user.checkout',compact('carts','subtotcart','final_tot','shipping_method'));

      }

      //=========================Sort By Date, price and name============================

      public function Sortby(Request $req)
      {
        $sort_val=$req->data;

        if($sort_val){
            $products=Product::orderBy($sort_val,'Asc')->get();
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

      public function stripe()
      {
        return view('user.stripe');
      }

       //=========================View Single Product=========================

    public function Check_Product($id)
    {

        $product=Product::where('product_publish','1')->where('id',$id)->first();

        if($product)
        {
            $category_id=Product::where('product_publish','1')->where('id',$id)->first()->category_id;
            $related_products_data=Product::where('product_publish','1')->where('id','!=',$id)->where('category_id',$category_id)->latest()->take(3)->get();
            $imageproduct=ProductImage::latest()->take(3)->get();
            return view('user.single-product',compact('product','related_products_data','imageproduct'));
        }
        else
        {
            return view('errors.404');
        }
    }

      //=========================Changing Currency============================

      public function Change_Currency_h(Request $req)
      {
        if(Auth::check()){
            $currency_d=$req->currency_va;
            User::where('id',Auth::user()->id)->update(['currency_id'=>$currency_d]);
            $user_currency=User::where('id',Auth::user()->id)->first()->currency_id;
            $new_currency=User::where('currency_id',$user_currency)->first()->currency()->first()->code;
            $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
            $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val->value;



            $categories=Category::latest()->where('category_status','1')->take(3)->get();
            $slide_products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->take(3)->get();
            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();

            return response()->json([
                'message'=>'currency changed to ',
                'new_currency'=>$new_currency,
                'status'=>200,
                'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart','final_tot')),
                'view'=>(String)View::make('user.includes.load-more',compact('slide_products','categories','products'))
            ]);
        }
        else{
            return response()->json([
                'message'=>'first login',
                'status'=>400,
            ]);
        }
      }


      public function Change_Currency(Request $req)
      {

        if(Auth::check()){
            $currency_d=$req->currency_va;
            User::where('id',Auth::user()->id)->update(['currency_id'=>$currency_d]);
            $user_currency=User::where('id',Auth::user()->id)->first()->currency_id;
            $new_currency=User::where('currency_id',$user_currency)->first()->currency()->first()->code;
            $shipping_method=User::where('currency_id',$user_currency)->first()->currency()->first()->shipping_method;
            $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
            $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val->value;




            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            return response()->json([
                'message'=>'currency changed to ',
                'new_currency'=>$new_currency,
                'status'=>200,
                'view'=>(String)View::make('user.includes.sort-category',compact('products')),
                'view_cart'=>(String)View::make('user.includes.cartItems',compact('carts','subtotcart','final_tot')),
                'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart','final_tot')),
                'order_summary'=>(String)View::make('user.includes.order-summary',compact('carts','subtotcart','final_tot','shipping_method')),
            ]);
        }
        else{
            return response()->json([
                'message'=>'first login',
                'status'=>400,
            ]);
        }
      }
      public function Change_Currency_s(Request $req)
      {

        if(Auth::check()){
            $currency_d=$req->currency_va;
            User::where('id',Auth::user()->id)->update(['currency_id'=>$currency_d]);
            $user_currency=User::where('id',Auth::user()->id)->first()->currency_id;
            $new_currency=User::where('currency_id',$user_currency)->first()->currency()->first()->code;
            $shipping_method=User::where('currency_id',$user_currency)->first()->currency()->first()->shipping_method;
            $user_shipping=User::where('id',Auth::user()->id)->first()->shipping_id;
            $shipping_val=User::where('shipping_id',$user_shipping)->first()->shipping()->first();
            $subtotcart=Cart::where('user_id',Auth::user()->id)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val->value;



            $carts=Cart::where('user_id',Auth::user()->id)->latest()->get();
            $products=Product::where('product_publish','1')->with('ProductImage')->latest()->get();
            $product_id=$req->product_id;
            $product=Product::where('product_publish','1')->where('id',$product_id)->first();
            $category_id=Product::where('product_publish','1')->where('id',$product_id)->first()->category_id;
            $related_products_data=Product::where('product_publish','1')->where('id','!=',$product_id)->where('category_id',$category_id)->latest()->take(3)->get();
            $imageproduct=ProductImage::latest()->take(3)->get();
            return response()->json([
                'message'=>'currency changed to ',
                'new_currency'=>$new_currency,
                'status'=>200,
                'header'=>(String)View::make('user.includes.cartheader',compact('carts','subtotcart','final_tot')),
                'product_details'=>view('user.includes.related_products',compact('product','related_products_data','imageproduct'))->render(),
                'product_price_details'=>(String)View::make('user.includes.product-details-price',compact('product')),
                'product_price_details_stick'=>(String)View::make('user.includes.product-details-price-stick',compact('product',)),
            ]);
        }
        else{
            return response()->json([
                'error'=>'Oops first login to change currency',
                'status'=>400,
            ]);
        }
      }

}
