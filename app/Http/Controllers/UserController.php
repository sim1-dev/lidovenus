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
        //qui prendo solo gli id che non sono come chiave esterna ad un utente
        //ma l'ho fatto funzionare diversamente
        /*
        $umbr_busy = DB::table('users')->whereNotNull('idumbrella')->pluck('idumbrella');
        $umbrella = DB::table('beach_umbrellas')->whereNotIn('id', $umbr_busy )->get();
        */

        $umbrellas = BeachUmbrella::orderBy('id','ASC')->get();
        $users = User::orderBy('id','ASC')->get();
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
       $user->password = Hash::make(strtolower($request->name.$request->surname));
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


    return redirect(route('user.index'))->with('success','User '.$lastiduser->id.' created');;

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

        //change orders umbrella:
        if ($user->idumbrella != $req->umbrella) {
            $user->idumbrella = $req->umbrella;
            $orders = $user->orders()->get();
            //dd($orders);
            if ($orders) {
                foreach ($orders as $key => $value) {
                    $order = Order::find($value->id);
                    $order->umbrellas()->sync($req->umbrella);
                }
            }
        }
        $user->save();


        return redirect(route('user.show',$id))->with('success','changes made to the user');
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
            return redirect(route('user.index'))->with('error', 'Impossible to delete the admin user');
        }

        $user = User::find($id);

        if ($user) {
            $safety_catch = 1;
            $orderusers = $user->orders()->get();

            foreach ($orderusers as $key) {
                //echo $key->id; HO l'id ordine
                //vedo se negli ordini dell'utente c'é un ordine non chiuso
                $orders = Order::find($key->id);
                if ($orders->delivered != 1) {
                    $safety_catch = 0;
                }
            }

            if ($safety_catch) {
                //se tutti gli ordini dell'utente sono chiusi provvedo ad eliminarli
                //prima di fare ciò, inserisco l'ordine nella tabella degli ordini eliminati
                //per avere la contabilità di questi ordini a breve cancellati

                //inserisco gli ordini della tabella degli ordini eliminati

                foreach ($orderusers as $key) {
                    $orders = Order::find($key->id);
                    DB::table('order_deletes')->insert([
                        [
                            'id_products' => $orders->id_products,
                            'created_at' => $orders->created_at,
                            'updated_at' => $orders->updated_at
                        ]
                    ]);

                    //prendo l'ordine appena inserito nella tabella order eliminata
                    $lastid = DB::table('order_deletes')->latest('id')->first();
                    $orderdelete = OrderDelete::find($lastid->id);
                    //prendo i suoi prodotti per inserirli nella relazione n a n con prodotti
                    $listaprodottinellordine = json_decode($orderdelete->id_products, true);
                    foreach ($listaprodottinellordine as $key =>$value) {
                        $prodottoid = Product::find($value['id']);
                        $orderdelete->products()->attach($prodottoid,['quantity' => $value['quantity']]);
                    }
                    //una volta completato l'inserimento provvedo alla cancellazione:

                    //tra order e product
                    $orders->products()->detach();
                    //tra order e umbrella
                    $orders->umbrellas()->detach();
                    //tra ordini e user
                    $orders->users()->detach();
                    //cancello quest'ordine
                    $orders->delete();


                }

                //tra subscription e user
                //forse il detach ha qualche problemino
                $subs = $user->subscriptions()->get();
                foreach ($subs as $key => $value) {
                    $sub = Subscription::find($value->id);
                    $sub->users()->detach();
                    $sub->delete();
                }
                //cancello l'user
                $user->delete();

                return redirect(route('user.index'))->with('success', 'User terminated');
            }
            //se risulta un utente con un ordine ancora aperto
            else{
                return redirect(route('user.index'))->with('error', 'User '.$id.' have order open');
            }

        }
        //non c'é nessun user con quell'id:
        else{
            return redirect(route('user.index'))->with('error', 'no user with that id');
        }
    }

    public function show($id)
    {
        if ($id == 1) {
            return redirect(route('user.index'))->with('error', 'you are admin');
        }
        $user = User::find($id);
        //$orders = DB::table('orders')->where();
        if ($user) {
            $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(7);
            $subscriptions = $user->subscriptions()->paginate(5);
            /*
            $umbr_busy = DB::table('users')->whereNotNull('idumbrella')->pluck('idumbrella');
            $umbrellass = DB::table('beach_umbrellas')->whereNotIn('id', $umbr_busy )->get();
            */
            return view('adminuser.user.show',compact('user','orders','subscriptions'));
        }
        else{
            return redirect(route('user.index'))->with('error', 'no user with that id');
        }
    }


}
