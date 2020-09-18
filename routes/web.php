<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Product;
use App\Order;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* Route Users: */
Route::get('/home', 'HomeController@index')->name('home')->middleware('is_user');

/* Redirect sul panel control: */
/* Route Admin: */
Route::get('/', function () {
	return redirect('admin/panelcontrol');
})->name('panelcontrol');

Route::get('admin/panelcontrol','HomeController@adminHome')->name('admin.home')->middleware('is_admin');

/* I controller: */
Route::resource('admin/product','ProductController')->middleware('is_admin');
Route::resource('admin/order','OrderController')->middleware('is_admin');//controller order
Route::resource('admin/user','UserController')->middleware('is_admin');
Route::resource('orderedit','Api\OrderController')->middleware('is_admin');//cart vuejs
Route::put('saveCart/{id}','Api\OrderController@SaveOrder')->middleware('is_admin');
Route::post('deleteproduct/{id}','Api\OrderController@deleteproduct')->middleware('is_admin');
Route::resource('admin/beachumbrella','BuController')->middleware('is_admin');
Route::resource('admin/brand','BrandController')->middleware('is_admin');
Route::resource('admin/beachumbrellaresult','Api\BeachUmbrellaResult')->middleware('is_admin');
Route::resource('admin/createorder','CreateOrderController')->middleware('is_admin');

//prova
Route::resource('prova/api','prova')->middleware('is_admin');

//pagina di controllo:
Route::resource('admin/pagecontrol','PageController')->middleware('is_admin');

Auth::routes([
	'register' => false
]);


//search prodotti
/*
Route::get ( '/search', function (Request $req) {
    $q = $req->product;
    if($q != ""){
    $product = Product::where ( 'name', 'LIKE', '%' . $q . '%' )->paginate(12);
    
    if (count ( $product ) > 0)
        return view ('adminuser.order.edit_order',compact('product'));
    }
        return back()->with(['error'=>'Prodotto non esiste']);
} );
*/
/*
    ->setPath( '' )
     $pagination = $product->appends ( array (
                'q' => $req->product 
        ) );

$q = $req->product;
    if($q != ""){
    $product = Product::where ( 'name', 'LIKE', '%' . $q . '%' )->paginate(12);
    
    if (count ( $product ) > 0)
        return view ('adminuser.order.edit_order',compact('product'));
    }
        return back()->with(['error'=>'Prodotto non esiste']);

        */



//serach prodotti with ajax
/*Route::post ( '/searchproduct', function (Request $req) {

    $q = $req->searchproduct;
    if($q != ""){
    $product = Product::where ( 'name', 'LIKE', '%' . $q . '%' )->paginate(12);
    
    if (count ( $product ) > 0)
        return response()->redirect()->view ('adminuser.order.edit_order',compact('product'));
    }
        return response()->json ( $req->searchproduct );

})->name('searchproduct');*/

/* esempio carrello: */
Route::get('caricacarello', function() {

    $product = Product::find(1);// assuming you have a Product model with id, name, description & price
	$rowId = $product->id; // generate a unique() row ID
	 // the user ID to bind the cart contents

// add the product to cart
	\Cart::clear();
	\Cart::add(array(
		'id' => $rowId,
		'name' => $product->name,
		'price' => $product->price,
		'quantity' => 4,
		//'attributes' => array(),
		'associatedModel' => 'Product'
	));
	$cart = \Cart::getContent();
	
	$carrello = $cart->toJson();
	//$carrello = $cart;

	//\Cart::session($user->id)->remove(3);
	\Cart::clear();


	//aggiorno cart sul db dell'user
	$user = User::find(2);
	//$userID = $user->id;
	$user->cart = $carrello;
	$user->save();


	return redirect('/');
	
});



