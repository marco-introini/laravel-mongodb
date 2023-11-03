<?php

use App\Models\UserMongoDB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ping MongoDB Connection
Route::get('/ping', function (Request $request) {
    $connection = DB::connection('mongodb');
    $msg = 'MongoDB is accessible!';
    try {
        $connection->command(['ping' => 1]);
    } catch (\Exception  $e) {
        $msg = 'MongoDB is not accessible. Error: '.$e->getMessage();
    }
    return ['msg' => $msg];
});

Route::get('/create_user_mongo', function (Request $request) {
    $success = UserMongoDB::create([
        'guid' => 'cust_1111',
        'first_name' => 'Marco',
        'email' => 'j.doe@gmail.com',
        'password' => '12345'
    ]);

    return json_encode([
       'status' => 'OK',
       'success' => $success,
    ]);
});
