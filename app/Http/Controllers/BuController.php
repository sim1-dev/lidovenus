<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BeachUmbrella;
use Illuminate\Support\Facades\DB;

class BuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umbrellas = DB::table('beach_umbrellas')->orderBy('id')->get();
        return view('adminuser.beachumbrella.index', compact('umbrellas'));
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
        $bu = new BeachUmbrella;
        $bu->type = $request->type;
        $bu->save();
        $lastid = BeachUmbrella::orderBy('id','desc')->first();
        return redirect(route('beachumbrella.index'))->with('success',"Ombrellone numero ".$lastid->id." creato con successo.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bu = BeachUmbrella::find($id);

        if ($bu) {
            $theordersumbrella = $bu->orders()->orderBy('delivered', 'asc')->paginate(7);
            //dd($theordersumbrella);
            return view('adminuser.beachumbrella.show',compact('bu','theordersumbrella'));
        }
        else{
            return redirect(route('beachumbrella.index'))->with('error','Ombrellone non esistente.');
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
    public function update(Request $request, $id)
    {
        $bu = BeachUmbrella::find($id); 
        if ($bu->type != $request->type) {
            $bu->type = $request->type;
            $bu->save();
        }
        return redirect(route('beachumbrella.show',$id))->with('success','Dati utente aggiornati con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {//controllo se ci sono gli ordini collegati aperti su questo ombrellone, se non ci sono li elimino
        $bu = BeachUmbrella::find($id);
        if ($bu) {
            $orderumbrella = $bu->orders()->get();
            foreach ($orderumbrella as $key => $value) {
                if ($value->delivered != 1) {
                    return redirect(route('beachumbrella.index'))->with('error',"L'ombrellone numero ".$id." ha ordini non completati");
                }
            }
            $bu->delete();
            return redirect(route('beachumbrella.index'))->with('success','Ombrellone eliminato con successo.');
        }
        else{
            return redirect(route('beachumbrella.index'))->with('error','Ombrellone non esistente');
        }
        
    }
}
