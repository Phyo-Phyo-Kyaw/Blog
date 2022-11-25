<?php

use App\Http\Controllers\CategoryApiController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

#GET /categories => index()
#GET /categories/{id} => show()
#POST /categories => store()
#PUT /categories/{id} => update()
#DELETE /categories/{id} => destory()
// Route::get('/categories', [CategoryApiController::class, 'index']);
// Route::get('/categories/{id}' , [CategoryApiController::class , 'show']);
// Route::post('/categories' ,[CategoryApiController::class , 'store']);
// Route::put('/categories/{id}' , [CategoryApiController::class , 'update']);
// Route::delete('/categories/{id}' , [CategoryApiController::class , 'destroy']);

Route::apiResource('/categories', CategoryApiController::class)->middleware('auth:sanctum');
Route::post('/login' , function(){
    $email = request()->email ;
    $password = request()->password ;

    $user = App\Models\User::where("email" , $email)->first();
    if(!$user) return response('Inncorrect mail' , 403);

    if(password_verify($password , $user->password)) {
        return $user->createToken("chrome")->plainTextToken ;
    }

    return response('Incorreect password' , 403);
});
Route::delete('/logout' , function(){
    request()->user()->tokens()->delete();
    return "logout successful";
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
