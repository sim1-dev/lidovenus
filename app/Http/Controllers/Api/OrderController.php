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
      $orderid = request('orderid');
      $order = Order::find($orderid);
      //Prendo i prodotti:
      $carrello =json_decode($order->id_products, true);
      //Instauro il cart default:
      \Cart::session(1)->add($carrello);
      //Instauro il cart per la modifica
      \Cart::session(2)->add($carrello);
      //Prendo quello che mi serve:
      $cart = \Cart::session(2)->getContent();
      $cart_total = \Cart::session(2)->getTotal();
      
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
      //Gioco sul product:
      $product = Product::find($request->product);
      $quantitydb = $product->quantitystock;
      //Se c e già nel carrello:
      if (\Cart::session(2)->get($product->id)) { 
      }
      //Non c'é nel carrello:
      else{
        \Cart::session(2)->add(array(
          'id' => $product->id,
          'name' => $product->name,
          'price' => $product->price,
          'quantity' => 1,
          //'attributes' => array(),
          'associatedModel' => 'Product'
        ));
      }

      $cart = \Cart::session(2)->getContent();
      $cart_total = \Cart::session(2)->getTotal();
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
    {}




    public function deleteproduct(Request $request,$id)
    {
      \Cart::session(2)->remove($id);
      $cart = \Cart::session(2)->getContent();
      $cart_total = \Cart::session(2)->getTotal();
      return response()->json(['cart' => $cart,'cart_total' => $cart_total]);
    }


    public function SaveOrder(Request $request, $id)
    {}
  }









