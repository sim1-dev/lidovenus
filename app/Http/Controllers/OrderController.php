<?php

namespace App\Http\Controllers;

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
        $order = Order::orderBy('created_at','ASC')->where('delivered',"!=", 1)->first();
        if ($order) {
            return redirect(route('order.show',$order->id));
            //return view('adminuser.order.cyclinganorder')->with('order',$order);
        }
        return redirect('admin/panelcontrol')->with('success','The orders are finished.');
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order = Order::find($request->idorder);
        $order->delivered = 1;
        $order->save();
        return redirect('/admin/panelcontrol')->with('success','Order closed');
        //return redirect()->route('panelcontrol')
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if ($order) {
            return view('adminuser.order.cyclinganorder',compact('order'));
        }
        return redirect('/admin/panelcontrol')->with('error','non exist order');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Cart::clear();
        \Cart::session(1)->clear();//cart default
        \Cart::session(2)->clear();//cart for alteration

        $order = Order::find($id);
        if ($order) {
            $carrello =json_decode($order->id_products, true);
            $orderid = $order->id;
            $delivered = $order->delivered;
            
            return view('adminuser.order.edit_order',compact('orderid','delivered'));
        }
        else{
            return redirect('/admin/panelcontrol')->with('error','non exist order');
        }
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
        $order = Order::find($id);
        $order->delivered = $request->delivered;
        $order->save();
        return redirect()->route('order.index');//return redirect()->route('order.index');
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

    public function ciao(){

        $cart = \Cart::getContent();
        $cart2 = Product::select('category')->distinct('category')->get();
        return $cart2;
    }
}
