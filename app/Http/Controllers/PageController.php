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

        $Pizze = DB::table('products')->where('category',"=","Pizze")->get();
        $Desk = DB::table('products')->where('category',"=","Panini")->get();
        $Bevande = DB::table('products')->where('category',"=","Bevande")->get();
        $Ice_creams = DB::table('products')->where('category',"=","Gelati")->get();

        $Orders_this_year = DB::table('orders')->where('delivered',"=",1)->whereYear('created_at', date('Y'))->get();
        $Orders_last_year = DB::table('orders')->where('delivered',"=",1)->whereYear('created_at', date('Y')-1)->get();
        $Lastest_completed_orders = DB::table('orders')->where('delivered',"=",1)->orderby('updated_at')->take(5)->get();

        $Completed_orders_number = DB::table('orders')->where('delivered',"=",1)->count();
        $Open_orders_number = DB::table('orders')->where('delivered',"=",0)->count();               //più veloce con numeri alti e PDO friendly
        $Users_number = DB::table('users')->count();


        return view('adminuser.pagecontrol', compact('Pizze','Desk','Bevande','Ice_creams','Orders_this_year','Orders_last_year', 'Completed_orders_number', 'Users_number', 'Open_orders_number', 'Lastest_completed_orders'));
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
