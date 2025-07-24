<?php
    // use Illuminate\Routing\Route;

use App\Http\Controllers\Pages\Schedual\SchedualController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
   
Route::prefix('/Schedual')
->controller(SchedualController::class)
->name('pages.Schedual.')
->middleware(CheckLogin::class)
->group(function(){

        Route::get('','index')->name('list');
        // Route::post('store','store')->name('store');
        // Route::post('update', 'update')->name('update');
        // Route::post('deActive/{id}','deActive')->name('deActive'); 
    
});
   

?>