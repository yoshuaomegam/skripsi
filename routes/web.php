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
Route::get('/pengujian1','Driver@create');
Route::get('/pengujian2','Driver@store');
Route::get('/pengujian3/{$id}','Driver@index');
Route::get('/apbdesa', function () {
    return view('apbdesa');
});
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Auth::routes();
Route::get('/cek', 'HomeController@cek')->name('cek');

Route::middleware('role:operator')->group(function (){
    Route::get('/operator','OperatorController@index')->name('operatorhome');
    Route::get('/admin/pelaporan','PelaporanController@index')->name('admin.pelaporan');
    Route::get('/admin/tambahpelaporan','PelaporanController@create')->name('admin.pelaporan.create');
    Route::post('/admin/simpanpelaporan','PelaporanController@store')->name('admin.pelaporan.store');
    Route::get('/admin/menupelaporan/{id}','PelaporanController@show')->name('admin.pelaporan.show');
    Route::get('/admin/editpelaporan/{id}','PelaporanController@edit')->name('admin.pelaporan.edit');
    Route::post('/admin/updatepelaporan/{id}','PelaporanController@update')->name('admin.pelaporan.update');
    Route::delete('/admin/hapuspelaporan/{id}','PelaporanController@destroy')->name('admin.pelaporan.delete');
   
    Route::get('/admin/menupelaporan/{id}/perencanaan','PerencanaanController@index')->name('admin.perencanaan');
    Route::get('/admin/menupelaporan/{id}/perencanaan/tambahperencanaan','PerencanaanController@create')->name('admin.perencanaan.create');
    Route::post('/admin/menupelaporan/{id}/perencanaan/simpanperencanaan','PerencanaanController@store')->name('admin.perencanaan.store');
    Route::post('/admin/menupelaporan/{id}/perencanaan/simpandetailperencanaan','PerencanaanController@store2')->name('admin.perencanaan.store2');
    Route::post('/admin/menupelaporan/{id}/perencanaan/updateperencanaan/{id_perencanaan}','PerencanaanController@update')->name('admin.perencanaan.update');
    Route::post('/admin/menupelaporan/{id}/perencanaan/updatedetailperencanaan/{id_perencanaan}','PerencanaanController@update2')->name('admin.perencanaan.update2');
    Route::delete('/admin/hapuspelaporan/{id}/perencanaaan/hapusperencanaan/{id_perencanaan}','PerencanaanController@destroy')->name('admin.perencanaan.delete');
    Route::delete('/admin/hapuspelaporan/{id}/perencanaaan/hapusdetailperencanaan/{id_perencanaan}','PerencanaanController@destroy2')->name('admin.perencanaan.delete2');
    Route::get('/admin/menupelaporan/{id}/apbdesa','APBDesaController@index')->name('admin.apbdesa');
    Route::get('/admin/menupelaporan/{id}/apbdesa/pendapatan','PendapatanController@create')->name('admin.pendapatan.create');
    Route::post('/admin/menupelaporan/{id}/pendapatan/simpanpendapatan','PendapatanController@store')->name('admin.pendapatan.store');
    Route::get('/admin/menupelaporan/{id}/apbdesa/showpendapatan/{id_pendapatan}','PendapatanController@show')->name('admin.pendapatan.show');
    Route::get('/admin/menupelaporan/{id}/apbdesa/editpendapatan/{id_pendapatan}','PendapatanController@edit')->name('admin.pendapatan.edit');
    Route::post('/admin/menupelaporan/{id}/apbdesa/updatependapatan/{id_pendapatan}','PendapatanController@update')->name('admin.pendapatan.update');
    Route::delete('/admin/menupelaporan/{id}/apbdesa/hapuspendapatan/{id_pendapatan}','PendapatanController@destroy')->name('admin.pendapatan.delete');
    Route::post('/admin/menupelaporan/{id}/apbdesa/simpandetailpendapatan/{id_pendapatan}','PendapatanController@store2')->name('admin.pendapatan.store2');
    Route::post('/admin/menupelaporan/{id}/apbdesa/updatependapatan/{id_pendapatan}/updatedetail/{id_detail}','PendapatanController@update2')->name('admin.pendapatan.update2');
    Route::delete('/admin/menupelaporan/{id}/apbdesa/editpendapatan/{id_pendapatan}/hapusdetail/{id_detail}','PendapatanController@destroy2')->name('admin.pendapatan.delete2');
});
Route::middleware('role:bappemas')->group(function (){
    Route::get('/bappemas','BappemasController@index')->name('bappemashome');
     Route::get('/kecamatan','KecamatanController@index')->name('kecamatan');
     Route::post('/simpankecamatan','KecamatanController@store')->name('kecamatan.store');
     Route::post('/editkecamatan/{id}','KecamatanController@update')->name('kecamatan.update');
     Route::delete('/hapuskecamatan/{id}','KecamatanController@destroy')->name('kecamatan.delete');
     Route::post('/importkecamatan','KecamatanController@import')->name('kecamatan.import');
    
     Route::get('/desa','DesaController@index')->name('desa');
     Route::get('/tambahdesa','DesaController@create')->name('desa.create');
     Route::post('/simpandesa','DesaController@store')->name('desa.store');
     Route::delete('/hapusdesa/{id}','DesaController@destroy')->name('desa.delete');

    
   
});