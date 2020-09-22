<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Order;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\DB;

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
        $products = DB::table('products')->orderBy('id')->paginate(5);
        return view('adminuser.product.index',compact('brand', 'products'));
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
                'image' => 'nullable|mimes:jpeg,png,jpg|max:5000000',
            ],
            [
                'name.required'=>'Inserisci nome prodotto',
                'name.unique'=>'Stesso nome nel db',
                'name.max'=>'Max 200 caratteri',
                'price.required' => 'Inserisci prezzo del prodotto',
                'image.mimes' => 'Estensioni accettate: jpeg - png - jpg; Dimensione massima file: 50MB',
            ]
        );

        $product = new Product;
        $product->name = $request->name;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imageName = time().'.'.$request->img->extension();
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
        return redirect(route('product.index'))->with('success',"Prodotto numero ".$lastid->id." creato con successo.");
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
            return redirect(route('product.index'))->with('error','Prodotto inesistente.');
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

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $imageName = time().'.'.$request->img->extension();
            $file->move(public_path('images_products'), $imageName);
            $product->img = $imageName;

        }

        $product->save();
        return redirect(route('product.show',$product->id))->with('success',"Prodotto aggiornato con successo.");
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
            foreach ($productonorder as $key => $value) {
                $order = Order::find($value->id);


                if ($order->delivered != 1) {
                    return redirect(route('product.index'))->with('error','Questo prodotto si trova in un ordine non ancora concluso (ID Ordine: '.$order->id.')');
                }
            }
            $product->delete();
            return redirect(route('product.index'))->with('success','Prodotto eliminato con successo.');
        }else{
            return redirect(route('product.index'))->with('error','Prodotto inesistente');
        }
    }
}
