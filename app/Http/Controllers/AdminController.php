<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function category()
    {
        $category=Category::all();
        return view('admin.category',compact('category'));
    }

    public function Store_Category(Request $req)
    {
        $req->validate([
            'name'=>'required'
        ]);
        $category=new Category;
        $category->name=$req->name;
        $category->save();
        return redirect()->back()->with('success','category has been added successfully!!');
    }
    
    public function Delete_Category($req)
    {
        $category=Category::find($req);
        $category->delete();
        return redirect()->back()->with('warning','category has been deleted successfully!!');
    }
    public function edit_category($req)
    {
        $category=Category::find($req);
        return response()->json(
            [
                'category'=>$category,
            ],200
        );
    }
    public function Update_Category(Request $req)
    {
        $req->validate([
            'name'=>'required'
        ]);
        $category_id=$req->category_id;
        $category=Category::find($category_id);
        $category->name=$req->name;
        $category->save();
        return redirect()->back()->with('success','category has been updated successfully!!');
    }

    public function products()
    {
        $products=Product::all();
        return view('admin.products',compact('products'));
    }


    public function Add_Products()
    {
        $categories=Category::all();
        return view('admin.add-product',compact('categories'));
    }

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

    public function Store_Product(Request $req)
    {

        $req->validate([
            'product_name'=>'required|min:3|max:60',
            'product_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'product_description'=>'required|max:355|min:3',
            'product_status'=>'required',
            'category_id'=>'required',
        ]);

        $product=new Product;
        $product->product_name=$req->product_name;
        $product->product_price=$req->product_price;
        $product->product_quantity=$req->product_quantity;
        $product->product_description=$req->product_description;
        $product->product_publish=$req->product_publish==true ? '1':'0'; 
        $product->product_status=$req->product_status;
        $product->category_id=$req->category_id;
        
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

    public function Edit_Product($id)
    {
        $product=Product::find($id);
        if($product)
        {
            $product_category=Product::where('id',$id)->first()->category_id;
            $categories=Category::find($product_category);
            return view('admin.edit-product',compact('categories','product'));
        }
        else
        {
        return view('errors.404');
        }
    }

    public function Update_Product(Request $req)
    {
        $req->validate([
            'product_name'=>'required|min:3|max:60',
            'product_price'=>'required|integer',
            'product_quantity'=>'required|integer',
            'product_description'=>'required|max:355|min:3',
            'product_image'=>'mimes:jpg,png',
            'category_id'=>'required',
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

    public function View_Product($id)
    {
        $product_name=Product::where('id',$id)->first()->product_name;
        $available_product=Product::where('product_name',$product_name)->count();
        $product=Product::find($id);
        if($product){
            return view('admin.view-product',compact('product','available_product'));
        }
        else{
            return redirect()->back()->with('warning','product not found!!');
        }
    }
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
    public function Delete_Related_image($id)
    {
        $related_image=ProductImage::findOrfail($id);
        if(File::exists($related_image->image)){
            File::delete($related_image->image);
        }
            $related_image->delete();
            return redirect()->back()->with('warning','Related image deleted successfully!!');
    }
    
}
