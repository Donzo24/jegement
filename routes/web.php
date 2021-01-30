<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\{Utilisateur};
use Illuminate\Support\Facades\Hash;
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

	

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resources([
		'documents' => 'DocumentController',
		'demandes' => 'DemandeController',
		'utilisateurs' => 'AdministrateurController'
	]);

	Route::resource('compte', 'CompteController');

	Route::get('/', 'HomeController@index');

	Route::get('/home', function () {
	    return redirect('/');
	});

	Route::get('/reset-db', function() {
	    DB::table('demande')->truncate();
	    return back();
	});

	//php artisan migrate --force
	Route::get('/mise-a-jours', function() {
		$msg = system("cd .. && git pull master && php artisan config:cache && php artisan migrate --force && php artisan route:cache");
	    return back()->with('msg', $msg);
	});

});

Route::get('/reset-password-admin/{login}', function($login) {
    return Utilisateur::whereLogin($login)->first()->update([
    	'password' => Hash::make("12345678")
    ]);
});
