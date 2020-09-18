<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //Capisco di quale order si sta parlando:
      $order = Order::find(request('orderid'));
      $cartOrder = json_decode($order->id_products,true);
      if (!empty($cartOrder)) {
        \Cart::session(1)->add($cartOrder);
      }

      //Passo alla pagina:
      $cart = \Cart::session(1)->getContent();
      $cart_total = \Cart::session(1)->getTotal();
      
      return response()->json(['cart' => $cart,'cart_total' => $cart_total]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $product = Product::find($request->product);
      //Se c e già nel carrello:
      if (\Cart::session(1)->get($product->id)) { 
      }
      //Non c'é nel carrello:
      else{
        \Cart::session(1)->add(array(
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'quantity' => 1,
          //'attributes' => array(),
          'associatedModel' => 'Product'
        ));

        $product->quantitystock = $product->quantitystock - 1;
        $product->save();

        $order = Order::find($request->orderid);
        $cart = \Cart::session(1)->getContent();
        $order->id_products = $cart->toJson();
        $order->save();
      }

      

      $cart = \Cart::session(1)->getContent();
      $cart_total = \Cart::session(1)->getTotal();
      return response()->json(['cart' => $cart,'cart_total' => $cart_total]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      $product = Product::find($id);
      $productQuantityOnDb = $product->quantitystock;
      $productInput = $request->numberproduct;

      $productOnCart = \Cart::session(1)->get($id);
      $productOnCartArray = $productOnCart->toArray();

      $order = Order::find($request->orderid);
      
      if ($productQuantityOnDb > 0 || $productInput < $productOnCartArray['quantity'] ) {
      
      if ($productInput > 0) {
      
      switch ($productInput) {
        //$productInput == $itemproduct->quantity GESTITO DA VUE
        case $productInput > $productOnCartArray['quantity']:
          $result = $productInput - $productOnCartArray['quantity'];
          \Cart::session(1)->update($id, array(
            'quantity' => $result, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
          ));

          $product->quantitystock = $product->quantitystock - $result;
          $product->save();
          break;

          case $productInput < $productOnCartArray['quantity']:
            $result = $productInput - $productOnCartArray['quantity'];
            // you may also want to update a product by reducing its quantity, you do this like so:
            \Cart::session(1)->update($id, array(
              'quantity' => $result, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
            ));
  
            $product->quantitystock = $product->quantitystock + abs($result);
            $product->save();
            break;

          
        default:
          break;
      }
      $cart = \Cart::session(1)->getContent();
      $order->id_products = $cart->toJson();
      $order->save();
    }
  }
      $cart = \Cart::session(1)->getContent();
      $cart_total = \Cart::session(1)->getTotal();
      return response()->json(['cart' => $cart,'cart_total' => $cart_total]);
  }

    
    public function deleteproduct(Request $request, $id)
    {

      \Cart::session(1)->remove($id);
      $cart = \Cart::session(1)->getContent();
      $cart_total = \Cart::session(1)->getTotal();

      $product = Product::find($id);
      $product->quantitystock = $product->quantitystock + $request->quantity;
      $product->save();

      $order = Order::find($request->orderid);
      $order->id_products = $cart->toJson();
      $order->save();
      return response()->json(['cart' => $cart,'cart_total' => $cart_total]);
    
    }

    public function SaveOrder(Request $request, $id)
    {
      $order = Order::find($id);
      $order->delivered = $request->delivered;
      $order->save();
      return true;
    }
}









