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

// Route::get('/', function () {
//   return view('Auction/Home');
// });

Route::get('/', 'AuctionController@index')->name('Auction');
Route::put('/Auction/update/{id}', 'AuctionController@update')->name('Auction.update');
Route::get('/{id}', 'AuctionController@Searchindex')->name('SearchAuction');
Route::get('/Report/ReportAuction/{id}', 'AuctionController@ReportAuction')->name('ReportAuction');
