<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AgentController extends Controller
{
    public function index()
    {
        return view('agent.index');
    }
     public function Agent_Products()
     {
        $products=Product::where('product_status','1')->latest()->get();
        return view('agent.products',compact('products'));
     }

     public function View_Product_Details($id)
     {
        $product_name=Product::where('id',$id)->first()->product_name;
        $available_product=Product::where('product_name',$product_name)->count();
        $product=Product::find($id);
        if($product){
            return view('agent.view-product',compact('product','available_product'));
        }
        else{
            return redirect()->back()->with('warning','product not found!!');
        }
     }
}
