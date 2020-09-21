<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\BeachUmbrella;
use App\User;
use App\Order;

class CreateOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $umbrellas = BeachUmbrella::all();
        $users = User::where('is_admin','!=',1)->get();
        return view('adminuser.createorder.index',compact('products','umbrellas','users'));
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

        $array1 =  array (
            array(
                'product' => $request->product,
                'users' => $request->users,
                'quantity' => $request->quantity,
                'umbrella' => $request->umbrella,
                'product2' => $request->product2,
                'quantity2' => $request->quantity2,
            )
        );



        \Cart::clear();
        $order = new Order;
        $cart = [];
        foreach ($array1 as $key => $value ) {
            $product = Product::find($value['product']);
            $product->quantitystock = $product->quantitystock - $request->quantity;
            $product->save();
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'associatedModel' => 'Product'
            ));
            $createdcart = \Cart::getContent();
            $cart = $createdcart->toJson();

            if ($request->product2) {
                $product = Product::find($value['product2']);
                $product->quantitystock = $product->quantitystock - $request->quantity2;
                $product->save();
                \Cart::add(array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $request->quantity2,
                    'associatedModel' => 'Product'
                ));
                $createdcart = \Cart::getContent();
                $cart = $createdcart->toJson();
            }


        }

        foreach ($array1 as $key => $value ) {
            $user = User::find($value['users']);
            $umbrella = BeachUmbrella::find($value['umbrella']);

            $order = new Order;
            $order->delivered = 0;
            $order->id_products = $cart;
            $order->save();

            $lastorder = Order::orderBy('id','desc')->first();
            $listaprodottinellordine = json_decode($lastorder->id_products, true);
            foreach ($listaprodottinellordine as $keys =>$values) {
                $prodottoid = Product::find($values['id']);
                $order->products()->attach($prodottoid,['quantity' => $values['quantity']]);
            }

            $user->orders()->attach($lastorder->id);
            $umbrella->orders()->attach($lastorder->id);
        }

        return redirect(route('admin.home'))->with('success','Order created');







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
        return response()->json(['product' => $product]);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
