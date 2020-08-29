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


Route::resource('/deputies', 'DeputyController')->only(['index', 'show', 'store']);
Route::resource('/indemnities', 'IndemnityController')->only(['index', 'show', 'store']);

// Route::view('/', 'app');
Route::view('{path}', 'app')->where('path', '[\/\w\.-]*');


// Route::get('/teste', function(){
//     $url = 'http://dadosabertos.almg.gov.br/ws/prestacao_contas/verbas_indenizatorias/legislatura_atual/deputados/22581/2019/06';

//     $fileContents = file_get_contents($url);
//     $simpleXml = simplexml_load_string($fileContents);
    
//     return json_encode($simpleXml);
// });