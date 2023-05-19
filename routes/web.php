<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\TeachersController;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\ClassController;
use \App\Http\Controllers\RoleController;
use \App\Http\Controllers\PermissionController;
use \App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes();

Route::get('/profile' , function(){
      if(Auth::check()){
        return view('/profile/profile');
    }
    else{
        return redirect('/login');
    }
    /// this checks if the user is logged in,if logged then displays the profile page
    /// else
    /// returns the login page but we need to force it to reload to make it work
    /// we made a script in the profile page which will check if the navigation type is 2 which means it was accessed by pressing the back button
    /// if its 2 then it'll force the window to reload,executing the else statement in the above function
    /// I used this instead of the window.history.forward as done in other files because we still need the back button to be working if the user is logged in so
    /// the step is better
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('DisableBackButton');
Route::post('/profileedit' , [\App\Http\Controllers\ProfileController::class , 'test']);


Route::get('/students' ,[StudentController::class , 'index']);
Route::get('/logout' , 'Auth\LoginController@logout');

Route::controller(TeachersController::class)->prefix('/teacher')->group(function (){

    Route::get('/' , 'index');
    Route::get('/show' , 'show');
    Route::post('/create' , 'create');
    Route::get('/view/{id}' , 'viewMore');
    Route::get('/edit/{id}' , 'edit');
    Route::put('/update/' , 'update');
    Route::put('/updateclass' , 'updateClass');
    Route::get('/showclass/{id}','showClass');
    Route::post('/deleteclass/' , 'deleteClass');
    Route::delete('/delete','delete');
    Route::get('/classpage/{id}' , 'viewClassPage');
    Route::get('/teacherhomedetails' , 'teacherHomeDetails');
});
Route::controller(ClassController::class)->prefix('/class')->group(function (){
    Route::get('/' ,'index');
    Route::get('/view/{id}' , 'viewMore');
    Route::get('/view/classpage/{id}' , 'viewTeacherPage');//makes the user jump to the teacher page of the id
    Route::get('/view/studentpage/{id}' , 'viewStudentPage');//makes the user jump to the teacher page of the id
    Route::delete('view/deleteteacher/' , 'deleteTeacher');
    Route::get('view/updatestudentclass/{id}' , 'viewUpdatePage');
    Route::get('/delete/{id}' , 'delete');

});

Route::controller(StudentController::class)->prefix('/student')->group(function(){
    Route::get('/' ,'index');
    Route::get('/show' , 'show');
    Route::post('/create' , 'create');
    Route::get('/view/{id}' , 'viewMore');
    Route::delete('/delete','delete');
    Route::get('/edit/{id}' , 'edit');
    Route::put('/update/' , 'update');
    Route::get('/classpage/{id}' , 'viewClassPage');
    Route::get('/teacherpage/{id}' , 'viewTeacherPage');
    Route::post('/changeclass' , 'updateStudentClass');
});

Route::controller(RoleController::class)->prefix('/role')->group(function(){
    Route::get('/' , 'index');
    Route::get('/show' , 'show');
    Route::get('/view/{id}' , 'view');
    Route::post('/create' , 'create');
    Route::delete('/delete','delete');
    Route::get('/edit/{id}' , 'edit');
    Route::put('/update' , 'update');
    Route::get('/permissionview/{id}' , 'permissionview');
    Route::post('/assignpermission/{id}' , 'assignPermission');
    Route::delete('/revokepermission' , 'revokePermission');
});
Route::controller(PermissionController::class)->prefix('/permission')->group(function(){
    Route::get('/' , 'index');
    Route::get('/show' , 'show');
    Route::get('/view/{id}' , 'view');
    Route::post('/create' , 'create');
    Route::delete('/delete','delete');
    Route::get('/edit/{id}' , 'edit');
    Route::put('/update' , 'update');
    Route::get('/permissionview/{id}' , 'permissionview');
});
Route::controller(UserController::class)->prefix('/user')->group(function(){
    Route::get('/' , 'index');
    Route::get('/view/{id}' , 'view');
    Route::delete('/delete','delete');
    Route::get('/edit/{id}' , 'edit');
    Route::put('/update' , 'update');
    Route::get('/show/{id}' , 'show');
    Route::put('/assignrole/' , 'assignrole');
    Route::delete('/revokerole' , 'revokerole');
    Route::get('/rolepermission/{id}' , 'rolepermissions');

});
Route::get('/logout' , function (){
    Auth::logout();
});
//fix the viewmore page on the details page


