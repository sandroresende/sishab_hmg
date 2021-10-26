<?php

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
Route::group(['namespace' => 'api_painel', 'prefix' => 'api_painel'], function() {
    Route::get('/executivo/statusEmpreendimento', 'ApiController@buscarStatusEmpreendimento');
});



?>