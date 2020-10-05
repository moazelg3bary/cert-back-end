<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::post('/complete-profile', 'API\AuthController@completeProfile');
    Route::post('/upload', 'API\AuthController@uploadAvatar');
    Route::get('/me', 'API\AuthController@me');
});

Route::group(['prefix' => 'certificate', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'API\CertificateController@getCertificates');
    Route::post('/', 'API\CertificateController@newCertificate');
    Route::post('/upload', 'API\CertificateController@upload');
});

// Mc6ncCMxCmOCogEp