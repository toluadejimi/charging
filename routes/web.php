<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SimController;
use App\Http\Controllers\WorldNumberController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/proxy/prices', function (Illuminate\Http\Request $request) {
    // Get the 'country' query parameter
    $country = $request->query('country');

    // Make the request to the 5sim API from the Laravel server
    $response = Http::get('https://5sim.net/v1/guest/prices', [
        'country' => $country,
    ]);

    return $response->json();
});



//auth

Route::get('/',  [HomeController::class,'index']);




Route::get('assign-box', [HomeController::class,'assign_box']);
Route::post('assign-box-now', [HomeController::class,'assign_box_now']);
Route::get('success', [HomeController::class,'success']);
Route::post('check-out', [HomeController::class,'check_out']);
































