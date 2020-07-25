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
    // $processID = shell_exec("./test.dll 2>&1 &");
    // exec('ps ' . $processID, $processState);
    // new DOTNET('DllName, Version=4.0.30319.33440, Culture=neutral,
    // PublicTokenKey=14843e0419858c21', 'ClassName');
    // exec('amr');    
    // exec('dotnet /Users/amr/Development/Development/Websites/iprotect-backend/routes/test.dll amr');    
    $o = shell_exec('sudo dotnet /Users/amr/Downloads/iprotect/test.dll /Users/amr/Downloads/iprotect/test.pdf 123456');  
    dd($o);  
    // return view('welcome');
});
