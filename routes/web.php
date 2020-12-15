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
    return view('landing');
});

Route::get('/test', function () {
    // $o = shell_exec('sudo dotnet ~/test.dll ~/test.pdf 123456');  
    // dd($o);  

    // PDF::setOptions(['defaultFont' => 'courier-bold']);

    // return PDF::loadFile(public_path().'/certificate/index.html')->save(public_path().'/certificate/test.pdf')->stream('download.pdf');

    // $pdf = PDF::loadView('certificate.index');
    // return $pdf->stream('document.pdf');

    // return public_path().'/certificate/index.html';

    // return Redirect::to('/main/#/');


});
