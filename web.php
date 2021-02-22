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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function()
{
    echo("this is a test");
    // View 'loginView' has to be the name of the file in the views
    return view('loginView');
});

// When the data is posted from the login page
// with action set to 'dologin' it will come here
// Then route the request to a function called index
// in the LoginController 
Route::post('/dologin', 'LoginController@index');

Route::get('/login2', function()
{
    return view('login2');
});

// Route to add a customer
Route::get('/customer', function()
{
    return view('customer');
});

Route::post('/addCustomer', 'CustomerController@index');

// Route for add order
Route::get('/neworder', function()
{
    return view('order');
});

Route::post('/addorder', 'OrderController@index');