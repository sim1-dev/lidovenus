<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $Pizzas = DB::table('products')->where('category',"=","Pizzas")->get();  
        $Desk = DB::table('products')->where('category',"=","Desk")->get();
        $Drinks = DB::table('products')->where('category',"=","Drinks")->get();
        $Ice_creams = DB::table('products')->where('category',"=","Ice creams")->get();
        
        $Orders_this_year = DB::table('orders')->where('delivered',"=",1)->whereYear('created_at', date('Y'))->get();
        $Orders_last_year = DB::table('orders')->where('delivered',"=",1)->whereYear('created_at', date('Y')-1)->get();
        
        return view('adminuser.pagecontrol', compact('Pizzas','Desk','Drinks','Ice_creams','Orders_this_year','Orders_last_year'));
        /*
        $Desk = Product::where('category',"=", 'Desk')->count();
        $Drinks = Product::where('category',"=", 'Drinks')->count();
        $Ice_creams = Product::where('category',"=", 'Ice creams')->count();
        return view('adminuser.pagecontrol')->with(compact($Pizzas,$Desk,$Drinks,$Ice_creams));
        */
        //return view('adminuser.pagecontrol')->with(compact('Pizzas'));
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
}
