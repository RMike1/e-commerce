<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Purchase_Order;
use App\Models\Order_Product_Items;
use DB;

class AgentController extends Controller
{
    public function index()
    {
        return view('agent.index');
    }
     public function Agent_Products(Request $req)
     {
        if($req->category){

        $products=Category::where('name',$req->category)->first()->product()->where('product_status','1')->latest()->get();
        return view('agent.products',compact('products'));
        }
        else{
            $products=Product::where('product_status','1')->latest()->get();
            return view('agent.products',compact('products'));
        }

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

     public function Agent_Category()
     {
        $category=Category::all();
        return view('agent.category',compact('category'));
     }
     public function Purchase_Order ()
     {
        // $Po=Purchase_Order::all();
        $Po=DB::table('purchase__orders')->join('suppliers','suppliers.id','=','purchase__orders.supplier_id')->get();
        // dd($Po);
        return view('agent.purchase-order', compact('Po'));
     }

     public function Add_Purchase_Order ()
     {
        // $po_id=Purchase_Order::latest()->take(1)->first()->id;

        $po_invoice_no= 'PO-'.rand();
        $suppliers=Supplier::where('status','1')->latest()->get();
        return view('agent.create-purchase-order', compact('suppliers','po_invoice_no'));
     }

     public function Store_Purchase_Order (Request $req)
     {
        $req->validate([
            'inputs[*]product_name'=>'required',
            'inputs[*]product_price'=>'required',
            'inputs[*]product_quantity'=>'required',
            'inputs[*]product_total'=>'required',
            'date'=>'required',
            'invoice_no'=>'required',
            'information'=>'required',
            'supplier_name'=>'required',
        ]);

        $po=new Purchase_Order;
        $po->date=$req->date;
        $po->invoice_no=$req->invoice_no;
        $po->information=$req->information;
        $po->supplier_id=$req->supplier_name;
        $po->save();


        // $p_name=$req->product_name;
        // $p_price=$req->product_price;
        // $p_quantity=$req->product_quantity;
        // $p_total=$req->product_total;

        // dd($p_total);


        foreach($req->inputs as $val)
        {
            $po_i=new Order_Product_Items;
            $po_i->product_name=$val['product_name'];
            $po_i->product_price=$val['product_price'];
            $po_i->product_quantity=$val['product_quantity'];
            $po_i->product_total=$val['product_total'];
            $po_i->purchase_orders_id=$po->id;
            $po_i->save();
            // ['purchase_orders_id'=>$po->id],
            // dd($val);
            // DB::table('order__product__items')->insert([
            //     'product_name'=>
            // ]);
            // dd($test);
        }

        return redirect()->back()->with('success','purchase order has been sent!!');

    }
}
