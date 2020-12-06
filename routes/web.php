<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/upload', function () {
    return view('upload/index');
});
Route::get('/thongke',[App\Http\Controllers\AgentsController::class, 'getChart']);
Route::get('/admin', function () {
    return view('admin/index');
})->middleware('checklogin::class');
Route::get('/admin/create',[App\Http\Controllers\PostController::class, 'showform']);
// Route::post('/admin/create',[App\Http\Controllers\PostController::class, 'validationform' ]);
// Route::get('/admin/create', 'PostController@showform');
Route::post('/admin/create', 'PostController@validationform');

Route::get('/admin', function(){
  $jsonString = file_get_contents(base_path('public/json/2018-10-18_02-15-14_AM.final.json'));

  $data = json_decode($jsonString, true);
  // $json = file_get_contents('public/json/2018-10-18_02-15-14_AM.final.json');
  // $data = json_decode($json, true);
// cái này ko xử lý ngoài view, cồng kềnh lắm. thif
  return view('admin/index',compact('data'));


});

// Route::resource('admin', 'JsonController', ['only' => ['index',
//     'create', 'store', 'edit'
// ]]);
Route::resource('admin', 'AgentsController', ['only' => ['index'
]]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
