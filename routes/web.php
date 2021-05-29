<?php

use Illuminate\Support\Facades\Route;
use App\Models\Company;

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

Route::group(['domain' => '{tenant}.' . config('app.domain'), 'middleware' => 'tenant'], function () {

    Route::get('/', function () {
        $company = Company::firstOrFail();
        dd($company->toArray());
    });

});


Route::get('/', function () {
    return view('welcome');
});