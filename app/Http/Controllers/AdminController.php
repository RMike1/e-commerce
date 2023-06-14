<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Order;
use App\Models\Shipping;
use App\Models\Cart;
use App\Models\Supplier;
use App\Models\Currency;
use App\Http\Requests\CurrencyRequest;
use Notification;
use App\Notifications\MK_Shop;
use Barryvdh\DomPDF\Facade\PDF;

class AdminController extends Controller
{

    //=========================Index =========================

    public function index()
    {
        $customers=User::where('usertype','0')->count();
        $orders=Order::count();

        $tot_revenue=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->select('product_price')
            ->sum('product_price');


            $currentweek=Carbon::now()->Week();
            $previousweek=Carbon::now()->subMonth(2);
            $currentyear=Carbon::now()->year();



            $revenue=DB::select(
            DB::raw("SELECT products.product_name as products, SUM(orders.tot_amount) AS total FROM orders LEFT JOIN products on products.id = orders.product_id GROUP BY products.product_name;"));

            $total="";
            $data="";
            foreach($revenue as $val){
                $total.="".$val->total.",";
            }

            foreach($revenue as $info){
                $data.="'".$info->products."',";
            }
            $today=now()->today();
            $tomorrow=now()->tomorrow();
            $toDayEarning=Order::whereBetween('created_at',[$today,$tomorrow])->sum('tot_amount');

            $top_selling_products=DB::table('products')
            ->join('orders','orders.product_id','=','products.id')
            ->select('products.product_name as product_names','products.product_price as product_prices','orders.quantity as orderQty','orders.tot_amount as orderTot','orders.created_at as order_created_at')
            ->orderBy('orders.tot_amount','desc')
            ->groupBy('products.product_name')
            ->take(5)
            ->get();

            $pendings_no=Order::where('orders.payment_status','pending')->sum('orders.tot_amount');
            $rejected_no=Order::where('orders.payment_status','rejected')->sum('orders.tot_amount');
            $approved_no=Order::where('orders.payment_status','Approved')->sum('orders.tot_amount');



            $tot_sales=DB::select(DB::raw("SELECT orders.payment_status AS Label, SUM(orders.tot_amount) as Tot FROM orders GROUP BY orders.payment_status;"));

            $tot="";
            $sales_tot="";
            foreach($tot_sales as $value)
            {
                $tot.="".$value->Tot.",";
            }

            foreach($tot_sales as $infor)
            {
                $sales_tot.="'".$infor->Label."',";
            }

            return view('admin.index',compact('customers','orders','tot_revenue','tot_revenue','total','data','toDayEarning','top_selling_products','sales_tot','tot','pendings_no','rejected_no','approved_no'));
    }

    //=========================Category Page =========================

    public function category()
    {
        $category=Category::all();
        return view('admin.category',compact('category'));
    }

    //=========================Store Category =========================

    public function Store_Category(Request $req)
    {
        $req->validate([
            'name'=>'required|unique:categories',
            'category_image'=>'required|mimes:png,jpg',
            'category_status'=>'nullable',
            'category_position'=>'nullable|unique:categories',

        ]);
        $category=new Category;
        $category->slug=Str::slug($req->name,'-');
        $category->name=$req->name;
        $category->category_position=$req->category_position;
        $category->category_status=$req->category_status==true ? '1':'0';
        $category->category_image="storage/".$req->file('category_image')->store('category_images','public');

        $category->save();
        return redirect()->back()->with('success','category has been added successfully!!');
    }


    //=========================Delete Category =========================

    public function Delete_Category($req)
    {
        $category=Category::find($req);
        $category->delete();
        return redirect()->back()->with('warning','category has been deleted successfully!!');
    }


    //=========================Edit Category =========================

    public function edit_category(Request $req)
    {


        $category_id=$req->category_id;

        $category=Category::find($category_id);
        return response()->json(
            [
                'category'=>$category,
            ],200
        );
    }

    //=========================Update Category =========================

    public function Update_Category(Request $req)
    {
        $req->validate([
            'name'=>'required|unique:categories,name,'.$req->category_id,
            'category_image'=>'mimes:png,jpg',
            'category_status'=>'nullable',
            'category_position'=>'nullable|unique:categories,category_position,'.$req->category_id,
        ]);


        $category_id=$req->category_id;
        $category=Category::find($category_id);
        $category->name=$req->name;
        $category->category_position=$req->category_position;
        $category->slug=Str::slug($req->name,'-');
        $category->category_status=$req->category_status==true ? '1':'0';

        // dd($req->category_position);
        if($req->category_image)
        {
            $category->category_image="storage/".$req->file('category_image')->store('category_images','public');
        }
        $category->save();

        return redirect()->back()->with('success','category has been updated successfully!!');
    }


    //=========================Products Page=========================


    public function products(Request $req)
    {
        if($req->category)
        {
            $products=Category::where('name',$req->category)->first()->product()->get();
            return view('admin.products',compact('products'));

        }
        else{
            $products=Product::all();
            return view('admin.products',compact('products'));
        }
    }

    //=========================Add Products page=========================


    public function Add_Products()
    {
        $categories=Category::all();
        $suppliers=Supplier::latest()->get();
        return view('admin.add-product',compact('categories','suppliers'));
    }


    //=========================Add Products CKeditor Text Editor=========================


    public function ProductDescription(Request $request)
    {
    if($request->hasFile('upload')) {
        $filenamewithextension = $request->file('upload')->getClientOriginalName();

        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        $extension = $request->file('upload')->getClientOriginalExtension();

        $filenametostore = $filename.'_'.time().'.'.$extension;

        $request->file('upload')->storeAs('public/uploads', $filenametostore);

        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/uploads/'.$filenametostore);
        $msg = 'Image successfully uploaded';
        $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        @header('Content-type: text/html; charset=utf-8');
        echo $re;
        }
    }

    //=========================Store Products=========================


    public function Store_Product(Request $req)
    {

        $req->validate([
            'product_name'=>'required|min:3|max:60',
            'product_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'product_description'=>'required|max:355|min:3',
            'product_status'=>'required',
            'category_id'=>'required',
            'supplier_id'=>'required',
        ]);

        $product=new Product;
        $product->product_name=$req->product_name;
        $product->product_price=$req->product_price;
        $product->product_quantity=$req->product_quantity;
        $product->product_description=$req->product_description;
        $product->product_publish=$req->product_publish==true ? '1':'0';
        $product->product_status=$req->product_status;
        $product->category_id=$req->category_id;
        $product->supplier_id=$req->supplier_id;

        if($req->product_image)
        {
                $product->product_image='storage/'.$req->file('product_image')->store('products-images','public');
        }
        $product->save();

        if($req->hasFile('image'))
        {
            $filePath='product_image/images/';
            $i=1;
            foreach($req->file('image') as $image){
                $extension=$image->getClientOriginalExtension();
                $filename=time().$i++.'.'.$extension;
                $image->move($filePath,$filename);
                $finalimagepath=$filePath.$filename;

                $productImage=new ProductImage;
                    $productImage->product_id=$product->id;
                    $productImage->image=$finalimagepath;
                    $productImage->save();
            }
        }
        return redirect()->back()->with('success','product has been added successfully!!');
    }

    //=========================Edit Product=========================


    public function Edit_Product($id)
    {
        $product=Product::find($id);
        if($product)
        {
            $product_category=Product::where('id',$id)->first()->category_id;
            $product_supplier=Product::where('id',$id)->first()->supplier_id;
            $categories=Category::find($product_category);
            $suppliers=Supplier::where('id','!=',$product_supplier)->get();
            $supplier=Supplier::find($product_supplier);
            if($supplier==null){
                $supplier=0;
            }
            return view('admin.edit-product',compact('categories','product','supplier','suppliers'));


        }
        else
        {
        return view('errors.404');
        }
    }

    //=========================Update Products=========================


    public function Update_Product(Request $req)
    {
        $req->validate([
            'product_name'=>'required|max:60',
            'product_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'product_description'=>'required|max:355|min:3',
            'product_image'=>'mimes:jpg,png',
            'category_id'=>'required',
            'supplier_id'=>'required',
        ]);

        $product_id=$req->product_id;
        $product=Product::find($product_id);

        $product->product_name=$req->product_name;
        $product->product_price=$req->product_price;
        $product->product_quantity=$req->product_quantity;
        $product->product_description=$req->product_description;
        $product->product_status=$req->product_status;
        $product->product_publish=$req->product_publish==true ? '1':'0';
        $product->category_id=$req->category_id;
        $product->supplier_id=$req->supplier_id;

        if($req->product_image)
        {
                $product->product_image='storage/'.$req->file('product_image')->store('products-images','public');
        }
        $product->save();

        if($req->hasFile('image'))
        {
            $filePath='product_image/images/';
            $i=1;
            foreach($req->file('image') as $image){
                $extension=$image->getClientOriginalExtension();
                $filename=time().$i++.'.'.$extension;
                $image->move($filePath,$filename);
                $finalimagepath=$filePath.$filename;

                $productImage=new ProductImage;
                    $productImage->product_id=$product->id;
                    $productImage->image=$finalimagepath;
                    $productImage->save();
            }
            }
        return redirect(route('products'))->with('success','product has been updated successfully!!');

    }

    //=========================View Single Product Admin panel=========================


    public function View_Product($id)
    {
        $product_name=Product::where('id',$id)->first()->product_name;
        $product_order_number=Order::where('product_id',$id)->count();
        $revenue_order=Order::where('product_id',$id)->sum('tot_amount');
        // dd($revenue_order);
        $available_product=Product::where('product_name',$product_name)->count();
        $product=Product::find($id);
        if($product){
            return view('admin.view-product',compact('product','available_product','product_order_number','revenue_order'));
        }
        else{
            return redirect()->back()->with('warning','product not found!!');
        }
    }

    //=========================Delete Products=========================

    public function Delete_Product($id)
    {
        $product=Product::find($id);
        if($product){
            $product->delete();
            return redirect()->back()->with('warning','product has been deleted successfully!!');
        }
        else{
            return redirect()->back()->with('warning','product not found!!');
        }
    }


    //=========================Delete Related Product's Images=========================


    public function Delete_Related_image($id)
    {
        $related_image=ProductImage::findOrfail($id);
        if(File::exists($related_image->image)){
            File::delete($related_image->image);
        }
        $related_image->delete();
        return redirect()->back()->with('warning','Related image deleted successfully!!');
    }
     //=========================update Users=========================

     public function Add_User(Request $req)
     {
        $req->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'usertype'=>'required',
        ]);

         $user=new User;
         $user->name=$req->name;
         $user->email=$req->email;
         $user->usertype=$req->usertype;
         $user->password=Hash::make($req->password);
         $user->save();

         return redirect(route('users'))->with('success','user added successfully!!');
     }

    //=========================View Users=========================

    public function Users()
    {
        $users=User::all();
        return view('admin.users',compact('users'));
    }

    //=========================Edit Users=========================

    public function Edit_User($id)
    {
        $users=User::find($id);
        return view('admin.edit-user',compact('users'));
    }

    //=========================update Users=========================

    public function Update_User(Request $req)
    {
        $user_id=$req->use_val;
        $req->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$req->use_val,
            'usertype'=>'required',
        ]);

        $user=User::find($user_id);
        $user->name=$req->name;
        $user->email=$req->email;
        $user->usertype=$req->usertype;
        $user->update();

        return redirect(route('users'))->with('success','user updated successfully!!');
    }

    //=========================update Users=========================

    public function Delete_User($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect(route('users'))->with('warning','user deleted successfully!!');

    }

    //=========================Orders=========================

    public function Orders()
    {
        $orders=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->select('products.*','orders.*','orders.quantity as orderQty','orders.tot_amount as orderTot')
            ->get();
        return view('admin.orders',compact('orders'));
    }

//=================View Single Order Details======================

    public function View_Order($id)
    {

        $tracking_no=Order::where('id',$id)->first()->tracking_no;
        $order_id=Order::where('id',$id)->first()->id;
        $order=Order::find($id);
        if($tracking_no)
        {
            $orders=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->select('products.*','orders.*','orders.quantity as orderQty','orders.tot_amount as orderTot','users.name as user_name')
            ->get();

            $shipping_method=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->first()->shipping_method;

            $shipping_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->first();

            $billing_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->first();

            $delivery_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->first();

            $shipping_delivery_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->select('orders.created_at')
            ->first();

            // dd($shipping_delivery_info_);

            $shipping_val=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)->where('orders.id',$order_id)
            ->first()->value;

            $subtotcart=Order::where('tracking_no',$tracking_no)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val;

            return view('admin.order-details',compact('orders','tracking_no','subtotcart','final_tot','shipping_method','shipping_val','order','shipping_info','billing_info','delivery_info','shipping_delivery_info'));
        }
        else
        {
            return redirect('404');
        }
    }

    //=================View Invoice Details======================

    public function View_Invoice($id)
    {
        $tracking_no=Order::where('id',$id)->first()->tracking_no;
        $order=Order::find($id);
        if($tracking_no)
        {
            $orders=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->select('products.*','orders.*','orders.quantity as orderQty','orders.tot_amount as orderTot','users.name as user_name')
            ->get();

            $shipping_method=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first()->shipping_method;

            $shipping_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $billing_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $delivery_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $shipping_val=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first()->value;

            $subtotcart=Order::where('tracking_no',$tracking_no)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val;

            return view('admin.invoice',compact('orders','tracking_no','subtotcart','final_tot','shipping_method','shipping_val','order','shipping_info','billing_info','delivery_info'));

        }
        else
        {
            return redirect('404');
        }
    }

    //=================Download Invoice======================

    public function Download_Invoice($id)
    {
            $tracking_no=Order::where('id',$id)->first()->tracking_no;
            $order=Order::find($id);
            $orders=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->select('products.*','orders.*','orders.quantity as orderQty','orders.tot_amount as orderTot','users.name as user_name')
            ->get();

            $shipping_method=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first()->shipping_method;

            $shipping_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $billing_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $delivery_info=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first();

            $shipping_val=DB::table('orders')
            ->join('products','products.id','=','orders.product_id')
            ->join('shippings','shippings.id','=','orders.shipping_id')
            ->join('users','users.id','=','orders.user_id')
            ->where('tracking_no',$tracking_no)
            ->first()->value;

            $subtotcart=Order::where('tracking_no',$tracking_no)->sum('tot_amount');
            $final_tot=$subtotcart+$shipping_val;

            $pdf = PDF::loadView('admin.invoice-download',compact('orders','tracking_no','subtotcart','final_tot','shipping_method','shipping_val','order','shipping_info','billing_info','delivery_info'));
            return $pdf->download('invoice-'.$tracking_no.'.'.'pdf');
    }

    //=================Cancel order====================
      public function Cancel_Order($id)
      {
       $order=Order::find($id);
       $order->payment_status="rejected";
       $order->update();
       return redirect()->back()->with('warning','order has been rejected successfully!!');
      }

    //=================Approve order====================

      public function Approve_Order($id)
      {
       $order=Order::find($id);
       $order->payment_status="Approved";
       $order->update();
       return redirect()->back()->with('success','order has been approved successfully!!');
      }

    //=================Undo order====================

      public function Undo_Order($id)
      {
       $order=Order::find($id);
       $order->payment_status="pending";
       $order->update();
       return redirect()->back()->with('success','order has been restored successfully!!');
      }

    //=================Mail User Page====================

      public function Send_Mail($id)
      {
            $order=Order::findOrfail($id);

            return view('admin.mail',compact('order'));
      }

    //=================Mailing User====================

      public function Send_Mail_Notification(Request $req, $id)
      {
        $order=Order::findOrfail($id);

        $details=[
            'greeting'=>$req->greeting,
            'first_line'=>$req->first_line,
            'body'=>$req->body,
            'url'=>$req->url,
            'button'=>$req->button,
            'last_line'=>$req->last_line,
        ];
        Notification::send($order, new MK_Shop($details));

        return redirect()->back()->with('success','email has been sent successfully!!');

      }

    //=================View Supplier====================


      public function View_Supplier()
        {
            $suppliers=Supplier::latest()->get();
            return view('admin.supplier',compact('suppliers'));
        }

    //=================Add Supplier====================


      public function Add_Supplier()
        {
            return view('admin.add-supplier');
        }

    //=================Store Supplier====================

      public function Store_Supplier(Request $req)
        {
            $req->validate([
                'first_name'=>'required',
                'second_name'=>'required',
                'status'=>'nullable',
            ]);

            $supplier=new Supplier;
            $supplier->first_name=$req->first_name;
            $supplier->second_name=$req->second_name;
            $supplier->status=$req->status==true ? '1' : '0';
            $supplier->save();

            return redirect()->back()->with('success', 'supplier saved successfully!');
        }

    //=================Edit Supplier====================

        public function Edit_Supplier(Request $req)
        {
            $supplier_id=$req->supplier_id;
            $supplier=Supplier::find($supplier_id);
            return response()->json([
                    'status'=>200,
                    'supplier'=>$supplier,
            ]);
        }

    //=================Update Supplier====================

        public function Update_Supplier(Request $req)
          {
              $req->validate([
                  'first_name'=>'required',
                  'second_name'=>'required',
                  'status'=>'nullable',
              ]);

              $supplier_id=$req->supplier_id;
              $supplier=Supplier::find($supplier_id);
              $supplier->first_name=$req->first_name;
              $supplier->second_name=$req->second_name;
              $supplier->status=$req->status==true ? '1' : '0';
              $supplier->update();

              return redirect()->back()->with('success', 'supplier updated successfully!');
            }

    //=================Delete Supplier====================

            public function Delete_Supplier($id)
            {
                $supplier=Supplier::find($id);
                $supplier->delete();

                return redirect()->back()->with('warning', 'supplier deleted successfully!');
            }

    //=================Currency Page====================

            public function Currency()
            {
                $currencies=Currency::latest()->get();
                return view('admin.currency',compact('currencies'));
            }

    //=================Store Currency====================

            public function Store_Currency(Request $request)
            {

                $validator=Validator::make($request->all(),[
                    'name'=>'required',
                    'code'=>'required',
                    'symbol'=>'required|max:1|string',
                    'normal_val'=>'required|numeric',
                    'us_value'=>'required|numeric',
                ],[
                    'normal_val.required'=>'Currency Value(According to RWF) field is required.',
                    'normal_val.numeric'=>'RWF value must be a number.',
                    'us_value.required'=>'Currency Value(According to US Dollar) field is required.',
                    'us_value.numeric'=>'US Dollar value must be a number.',
                ]);

                $req=$validator->validated();

                $currency=new Currency;
                $currency->name=$req->name;
                $currency->code=$req->code;
                $currency->symbol=$req->symbol;
                $currency->normal_val=$req->normal_val;
                $currency->us_value=$req->us_value;
                $currency->status=$req->status==true ? '1' : '0';
                $currency->save();

                return redirect()->back()->with('success', 'currency added successfully!!');

            }

    //=================Edit Currency====================

            public function Edit_Currency(Request $req){

                    $currency_id=$req->currency_val;
                    $currency=Currency::find($currency_id);

                    return response()->json([
                        'status'=>200,
                        'currency'=>$currency,
                    ]);

            }

    //=================Update Currency====================

              public function Update_Currency(Request $request){

                $validator=Validator::make($request->all(),[
                    'name'=>'required',
                    'code'=>'required',
                    'symbol'=>'required|max:1|string',
                    'normal_val'=>'required|numeric',
                    'us_value'=>'required|numeric',
                ],[
                    'normal_val.required'=>'Currency Value(According to RWF) field is required.',
                    'normal_val.numeric'=>'RWF value must be a number.',
                    'us_value.required'=>'Currency Value(According to US Dollar) field is required.',
                    'us_value.numeric'=>'US Dollar value must be a number.',
                ]);

                $req=$validator->validated();

                $currency_id=$request->id;
                $currency=Currency::find($currency_id);
                $currency->name=$request->name;
                $currency->code=$request->code;
                $currency->symbol=$request->symbol;
                $currency->normal_val=$request->normal_val;
                $currency->us_value=$request->us_value;
                $currency->update();

                return redirect()->back()->with('success', 'currency updated successfully!!');
            }

    //=================Update Currency_Status====================

            public function Update_Currency_Status(Request $req){
                $currency_id=$req->currency_va;
                if($req->status=='0'){
                $currency=Currency::find($currency_id);
                $currency->status=$req->status;
                $currency->update();
                    return response()->json([
                        'status'=>200,
                        'alert'=>'warning',
                        'message'=>'currency deactivated successfully!!',
                    ]);
                }
                else{
                    $currency=Currency::find($currency_id);
                    $currency->status=$req->status;
                    $currency->update();
                    return response()->json([
                        'status'=>200,
                        'alert'=>'success',
                        'message'=>'currency activated successfully!',
                    ]);
                }
            }

    //================= Delete Currency====================

            // public function Delete_Currency($id){

            //     $currency_counter=Currency::count();
            //     if($currency_counter<=1){
            //         return redirect()->back()->with('warning', 'Oops!! currency can\'t be empty! must be at least one currency! please add other currency and delete this after!!');
            //     }else{
            //         $currency=Currency::find($id);
            //         if($currency){
            //             $currency->delete();
            //         }
            //         else{
            //             return redirect()->back()->with('warning', 'currency not found!');
            //         }

            //         $currency_d=Currency::where('id','!=',$id)->first()->id;
            //         Currency::where('id',$currency_d)->update(['fr_use_status'=>'1']);

            //         return redirect()->back()->with('warning', 'currency deleted successfully!!');

            //     }

            // }
}
