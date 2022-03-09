<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\DB;
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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('contacts',[ ApiController::class, 'getAllContacts' ]);
Route::get('contacts/{id}',[ ApiController::class, 'getcontact' ]);
Route::post('contacts',[ ApiController::class, 'createContact' ]);
Route::put('contacts/{id}',[ ApiController::class, 'updateContact' ]);
Route::delete('contacts/{id}',[ ApiController::class, 'deleteContact' ]);