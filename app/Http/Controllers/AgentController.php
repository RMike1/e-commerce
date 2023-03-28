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
}
