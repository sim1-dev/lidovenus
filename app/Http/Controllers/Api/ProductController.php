<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Darryldecode\Cart\Cart;
use App\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //global helper request
        $sort_field = request('sort_field','created_at');
        if (!in_array($sort_field, ['name','name'])) {
            $sort_field = 'created_at';
        }

        $sort_direction = request('sort_direction','desc');
        if (!in_array($sort_direction, ['asc','desc'])) {
            $sort_direction = 'desc';
        }

        $product = Product::when(request('category_name','') != '', function($query){
            $query->where('category',request('category_name'));
        })->when(request('search_product','') != '', function($query){
            $query->where('name','like',"%".request('search_product')."%");
        })->where('quantitystock','!=',0)->orderBy($sort_field,$sort_direction)->paginate(10);
        return $product;

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        $order = Order::find(8);
        $carrello =json_decode($order->id_products, true);//array
            //$carrello2 =$order->id_products;//json
            
        \Cart::add($carrello);
        $cart = \Cart::getContent();
        return $cart;
        */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function category(){
        $categorie = Product::select('category')->distinct('category')->get();
        return $categorie;
    }
}
