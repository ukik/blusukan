<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/materi/detail/{id?}', function($id) {
    $url = App\MateriModel::findOrFail($id)->gambar;
    App\MateriModel::increment('dilihat');
    return Redirect::to($url);
});


// Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::group([
    'middleware' => [
        // 'jwt',
        // 'csrf', 
    ],
    'prefix' => 'user'
], function () {
    Route::get('/', 'AuthController@index');
});


Route::group([
    'middleware' => [
        // 'jwt',
        // 'csrf', 
    ],
    'prefix' => 'warga'
], function () {
    Route::get('/', 'WargaController@index');
    Route::post('/formulir', 'WargaController@formulir');
    Route::get('/{id}', 'WargaController@show');
    Route::get('/peta/tanggal/{tanggal}', 'WargaController@peta_tanggal');

    Route::get('/alasan', 'ViewWargaAlasanController@index');
    Route::get('/alasan/{id}', 'ViewWargaAlasanController@show');
    Route::get('/kegiatan', 'ViewWargaKegiatanController@index');
    Route::get('/kegiatan/{id}', 'ViewWargaKegiatanController@show');
    Route::get('/minat', 'ViewWargaMinatController@index');
    Route::get('/minat/{id}', 'ViewWargaMinatController@show');
    Route::get('/pilihan', 'ViewWargaPilihanController@index');
    Route::get('/pilihan/{id}', 'ViewWargaPilihanController@show');

});

Route::group([
    'middleware' => [
        // 'jwt',
        // 'csrf', 
    ],
    'prefix' => 'brosur'
], function () {
    Route::get('/', 'BrosurController@index');
    Route::post('/formulir', 'BrosurController@formulir');
    Route::get('/{id}', 'BrosurController@show');
    Route::get('/peta/tanggal/{tanggal}', 'BrosurController@peta_tanggal');
});

Route::group([
    'middleware' => [
        // 'jwt',
        // 'csrf', 
    ],
    'prefix' => 'materi'
], function () {
    Route::get('/', 'MateriController@index');
    Route::get('/{id}', 'MateriController@show');
});

Route::group([
    'middleware' => [
        // 'jwt',
        // 'csrf', 
    ],
    'prefix' => 'informasi'
], function () {
    Route::get('/', 'InformasiController@index');
    Route::get('/{id}', 'InformasiController@show');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
