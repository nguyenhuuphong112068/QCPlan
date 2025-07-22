<?php
    // use Illuminate\Routing\Route;

use App\Http\Controllers\Pages\Caterogy\SOPCategoryController;

use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;



Route::get('/primeReact', [SOPCategoryController::class, 'index2'])
->name('category.SOP.list');


Route::prefix('/category')
->name('pages.category.')
->middleware(CheckLogin::class)
->group(function(){

    Route::prefix('/SOP')
    ->name('SOP.')
    ->controller(SOPCategoryController::class)
    ->group(function(){
            Route::get('','index')->name('list');
            Route::get('create','showCreateProductNameForm')->name('create');
            Route::post('store','store')->name('store');
            Route::get('detail/{id}', 'detail')->name('detail');
            Route::post('update', 'update')->name('update');
            Route::post('deActive/{id}','deActive')->name('deActive'); 
    });







     

});
   

?>