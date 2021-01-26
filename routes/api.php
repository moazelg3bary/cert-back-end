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
Route::post('/forget-password', 'API\ForgetPasswordController@forgetPassword');
Route::post('/login', 'API\AuthController@login');
Route::post('password/reset/{token}', 'API\ForgetPasswordController@reset');

Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function () {
    Route::post('/complete-profile', 'API\AuthController@completeProfile');
    Route::post('/upload', 'API\AuthController@uploadAvatar');
    Route::get('/me', 'API\AuthController@me');
    Route::post('/profile', 'API\AuthController@updateProfile');
    Route::post('/editProfile', 'API\AuthController@editProfile');
});

Route::group(['prefix' => 'certificate', 'middleware' => ['addAccessToken', 'auth:api']], function () {
    Route::post('/test', 'API\CertificateController@test');
    Route::get('/', 'API\CertificateController@getCertificates');
    Route::get('/{id}', 'API\CertificateController@getCertificateById');
    Route::post('/', 'API\CertificateController@newCertificate');
    Route::post('/upload', 'API\CertificateController@upload');
    Route::post('/logo', 'API\CertificateController@uploadCompanyLogo');

});

Route::group(['prefix' => 'view'], function () {
    Route::get('certificate/{id}', 'API\ViewerController@ViewCertificate');
});


// Mc6ncCMxCmOCogEp
