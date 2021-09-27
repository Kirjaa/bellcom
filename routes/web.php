<?php

use App\Http\Controllers\XmlFilesParser\XmlFilesParserController as XmlFilesParserControllerAlias;
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

Route::prefix('/xml')->group(function () {
    Route::get('/view', [XmlFilesParserControllerAlias::class, 'showPage']);
    Route::get('/search', [XmlFilesParserControllerAlias::class, 'searchForXmlFile']);
});
