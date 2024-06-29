<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
], function() {
    Route::post('/quotation', 'QuotationController@store');
});
