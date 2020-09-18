<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Order;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::all();
        return view('adminuser.product.index',compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                'name' => 'required|max:200|unique:products',
                'image' => 'nullable|mimes:jpeg,png,jpg|max:50',
            ],
            [
                'name.required'=>'Insert name product',
                'name.unique'=>'Same name into db',
                'name.max'=>'Max 200 character',
                'price.required' => 'Insert price for product',
                'image.mimes' => 'type of file accept: jpeg - png - jpg and max size 50mb',
            ]
        );

        $product = new Product;
        $product->name = $request->name;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'.'.$request->image->extension();
            $file->move(public_path('images_products'), $imageName);
            $product->img = $imageName;

        }

        $product->price = $request->price;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->quantitystock = $request->quantitystock;
        $product->brand = $request->brand;
        $product->save();

        $lastid = Product::orderBy('id','desc')->first();
        return redirect(route('product.index'))->with('success',"Product ".$lastid->id." created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            $brand = Brand::all();
            return view('adminuser.product.show',compact('product','brand'));
        }
        else{
            return redirect(route('product.index'))->with('error','Product not exist');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product = Product::find($product->id);
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;
        if ($product->quantitystock) {
            $product->quantitystock = $request->quantitystock;
        }

        if ($request->price) {
            $product->price = $request->price;
        }
         
        $product->brand = $request->brand;
        $product->updated_at = now();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'.'.$request->image->extension();
            $file->move(public_path('images_products'), $imageName);
            $product->image = $imageName;

        }

        $product->save();
        return redirect(route('product.show',$product->id))->with('success',"product is updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $productonorder = $product->orders()->get();
            //dd($productonorder);
            foreach ($productonorder as $key => $value) {
                $order = Order::find($value->id);


                if ($order->delivered != 1) {
                    //dd($order);
                    return redirect(route('product.index'))->with('error','This Product is into another order not closed, Order:'.$order->id);
                }
            }
            $product->delete();
            return redirect(route('product.index'))->with('success','Product terminated');
        }else{
            return redirect(route('product.index'))->with('error','Product not exist');
        }
    }
}
