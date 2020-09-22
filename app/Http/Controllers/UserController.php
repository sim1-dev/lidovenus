<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BeachUmbrella;
use App\Order;
use App\OrderDelete;
use App\Product;
use App\Subscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $umbrellas = BeachUmbrella::orderBy('id','ASC')->get();
        $users = User::orderBy('id','ASC')->paginate(5);
        return view('adminuser.user.index',compact('umbrellas', 'users'));
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
       $validate = $request->validate(
        [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ],
        [
            'email.unique'=>'Email già esistente!'
        ]);

       $user = new User;
       $user->name = $request->name;
       $user->surname = $request->surname;
       $user->email = $request->email;
       $user->password = Hash::make($request->password);
       $user->save();
       unset($user);
       $lastiduser = User::orderBy('id','desc')->first();
       if ($request->umbrella) {
        $user = User::find($lastiduser->id);
        $sub = new Subscription;
        $sub->idumbrella = $request->umbrella;
        $originalDate1 = $request->dateinputdal;
        $originalDate2 = $request->dateinputal;
        $datefrom = date("Y-m-d", strtotime($originalDate1));
        $dateto = date("Y-m-d", strtotime($originalDate2));
        $sub->from = $datefrom;
        $sub->to = $dateto;
        $sub->save();
        $lastidsub = Subscription::orderBy('id','desc')->first();
        $subscri = Subscription::find($lastidsub->id);
        $user->subscriptions()->attach($subscri);
    }


    return redirect(route('user.index'))->with('success','Utente numero '.$lastiduser->id.' creato con successo.');;

}



    /**
     * Display the specified resource.
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
    public function update(Request $req, $id)
    {
        $user = User::find($id);
        $user->name = $req->name;
        $user->surname = $req->surname;
        $user->email = $req->email;
        $user->municipality = $req->municipality;
        $user->cap = $req->cap;
        $user->address = $req->address;
        $user->name = $req->name;
        $user->updated_at = now();

        if ($user->idumbrella != $req->umbrella) {
            $user->idumbrella = $req->umbrella;
            $orders = $user->orders()->get();
            if ($orders) {
                foreach ($orders as $key => $value) {
                    $order = Order::find($value->id);
                    $order->umbrellas()->sync($req->umbrella);
                }
            }
        }
        $user->save();


        return redirect(route('user.show',$id))->with('success','Dati utente aggiornati con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($id == 1) {
            return redirect(route('user.index'))->with('error', 'Impossibile eliminare un amministratore.');
        }

        $user = User::find($id);

        if ($user) {
            $safety_catch = 1;
            $orderusers = $user->orders()->get();

            foreach ($orderusers as $key) {
                $orders = Order::find($key->id);
                if ($orders->delivered != 1) {
                    $safety_catch = 0;
                }
            }

            if ($safety_catch) {

                foreach ($orderusers as $key) {
                    $orders = Order::find($key->id);
                    DB::table('order_deletes')->insert([
                        [
                            'id_products' => $orders->id_products,
                            'created_at' => $orders->created_at,
                            'updated_at' => $orders->updated_at
                        ]
                    ]);


                    $lastid = DB::table('order_deletes')->latest('id')->first();
                    $orderdelete = OrderDelete::find($lastid->id);

                    $listaprodottinellordine = json_decode($orderdelete->id_products, true);
                    foreach ($listaprodottinellordine as $key =>$value) {
                        $prodottoid = Product::find($value['id']);
                        $orderdelete->products()->attach($prodottoid,['quantity' => $value['quantity']]);
                    }



                    $orders->products()->detach();

                    $orders->umbrellas()->detach();

                    $orders->users()->detach();

                    $orders->delete();


                }


                $subs = $user->subscriptions()->get();
                foreach ($subs as $key => $value) {
                    $sub = Subscription::find($value->id);
                    $sub->users()->detach();
                    $sub->delete();
                }

                $user->delete();

                return redirect(route('user.index'))->with('success', 'Utente eliminato con successo.');
            }

            else{
                return redirect(route('user.index'))->with('error', "L'utente numero '.$id.' ha ordini non completati");
            }

        }

        else{
            return redirect(route('user.index'))->with('error', "Nessun utente con quell'ID");
        }
    }

    public function show($id)
    {
        if ($id == 1) {
            return redirect(route('user.index'))->with('error', "L'utente è un amministratore.");
        }
        $user = User::find($id);
        if ($user) {
            $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(7);
            $subscriptions = $user->subscriptions()->paginate(5);
            return view('adminuser.user.show',compact('user','orders','subscriptions'));
        }
        else{
            return redirect(route('user.index'))->with('error', "Nessun utente esistente con quell'ID.");
        }
    }


}
