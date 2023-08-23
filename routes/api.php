<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiasController;

Route::get('/', function(){
    return response()->json([
'success' => true
    ]);
});

Route::get('/noticias',[NoticiasController::class,'index']);
Route::post('/noticias',[NoticiasController::class,'store']);
Route::delete('/noticias/{id}',[NoticiasController::class,'destroy']);



