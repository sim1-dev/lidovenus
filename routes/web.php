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

Route::get('/index', function () {
	return view('welcome');
})->name('index');

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

Route::get('caricacarello', function() {

    $product = Product::find(1);// assuming you have a Product model with id, name, description & price
	$rowId = $product->id; // generate a unique() row ID
	 // the user ID to bind the cart contents

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

	//\Cart::session($user->id)->remove(3);
	\Cart::clear();

	$user = User::find(2);
	//$userID = $user->id;
	$user->cart = $carrello;
	$user->save();


	return redirect('/');

});



