<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('/login', function(Request $request) {
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = auth()->user();
        $tokenResult = $user->createToken("Personal Access Token");
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => "Bearer ". $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
});
