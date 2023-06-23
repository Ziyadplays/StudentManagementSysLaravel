<?php

use App\Http\Controllers\ClassController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::controller(TeachersController::class)->prefix('/teacher')->group(function () {
    Route::get('/', 'index')->middleware('can:view-teachers');
    Route::get('/show', 'show')->middleware('can:view-teachers');
    Route::post('/create', 'create')->middleware('can:view-teachers');
    Route::get('/view/{id}', 'viewMore')->middleware('can:view-teachers');
    Route::get('/edit/{id}', 'edit')->middleware('can:view-teachers');
    Route::put('/update/', 'update')->middleware('can:view-teachers');
    Route::put('/updateclass', 'updateClass')->middleware('can:view-teachers');
    Route::get('/showclass/{id}', 'showClass')->middleware('can:view-teachers');
    Route::post('/deleteclass/', 'deleteClass')->middleware('can:view-teachers');
    Route::delete('/delete', 'delete')->middleware('can:view-teachers');
    Route::get('/classpage/{id}', 'viewClassPage')->middleware('can:view-teachers');
    Route::get('/teacherhomedetails', 'teacherHomeDetails')->middleware('can:view-teachers');
});
Route::controller(ClassController::class)->prefix('/class')->group(function () {
    Route::get('/', 'index')->middleware('can:view-classes');
    Route::get('/view/{id}', 'viewMore')->middleware('can:view-classes');
    Route::get('/view/classpage/{id}', 'viewTeacherPage')->middleware('can:view-classes');//makes the user jump to the teacher page of the id
    Route::get('/view/studentpage/{id}', 'viewStudentPage')->middleware('can:view-classes');//makes the user jump to the teacher page of the id
    Route::delete('view/deleteteacher/', 'deleteTeacher')->middleware('can:view-classes');
    Route::get('view/updatestudentclass/{id}', 'viewUpdatePage')->middleware('can:view-classes');
    Route::get('/delete/{id}', 'delete')->middleware('can:view-classes');

});

Route::controller(StudentController::class)->prefix('/student')->group(function() {
    Route::get('/', 'index')->middleware('can:view-students');
    Route::get('/show', 'show')->middleware('can:view-students');
    Route::post('/create', 'create')->middleware('can:view-students');
    Route::get('/view/{id}', 'viewMore')->middleware('can:view-students');
    Route::delete('/delete', 'delete')->middleware('can:view-students');
    Route::get('/edit/{id}', 'edit')->middleware('can:view-students');
    Route::put('/update/', 'update')->middleware('can:view-students');
    Route::get('/classpage/{id}', 'viewClassPage')->middleware('can:view-students');
    Route::get('/teacherpage/{id}', 'viewTeacherPage')->middleware('can:view-students');
    Route::post('/changeclass', 'updateStudentClass')->middleware('can:view-students');
});

Route::controller(RoleController::class)->prefix('/role')->group(function() {
    Route::get('/', 'index')->middleware('can:view-roles');
    Route::get('/show', 'show')->middleware('can:view-roles');
    Route::get('/view/{id}', 'view')->middleware('can:view-roles');
    Route::post('/create', 'create')->middleware('can:view-roles');
    Route::delete('/delete', 'delete')->middleware('can:view-roles');
    Route::get('/edit/{id}', 'edit')->middleware('can:view-roles');
    Route::put('/update', 'update')->middleware('can:view-roles');
    Route::get('/permissionview/{id}', 'permissionview')->middleware('can:view-roles');
    Route::post('/assignpermission/{id}', 'assignPermission')->middleware('can:view-roles');
    Route::delete('/revokepermission', 'revokePermission')->middleware('can:view-roles');
});
Route::controller(PermissionController::class)->prefix('/permission')->group(function() {
    Route::get('/', 'index')->middleware('can:view-permissions');
    Route::get('/show', 'show')->middleware('can:view-permissions');
    Route::get('/view/{id}', 'view')->middleware('can:view-permissions');
    Route::post('/create', 'create')->middleware('can:view-permissions');
    Route::delete('/delete', 'delete')->middleware('can:view-permissions');
    Route::get('/edit/{id}', 'edit')->middleware('can:view-permissions');
    Route::put('/update', 'update')->middleware('can:view-permissions');
    Route::get('/permissionview/{id}', 'permissionview')->middleware('can:view-permissions');
});

Route::controller(UserController::class)->prefix('/user')->group(function() {
    Route::get('/', 'index')->middleware('can:view-users');
    Route::get('/view/{id}', 'view')->middleware('can:view-users');
    Route::delete('/delete', 'delete')->middleware('can:view-users');
    Route::get('/edit/{id}', 'edit')->middleware('can:view-users');
    Route::put('/update', 'update')->middleware('can:view-users');
    Route::get('/show/{id}', 'show')->middleware('can:view-users');
    Route::put('/assignrole/', 'assignrole')->middleware('can:view-users');
    Route::delete('/revokerole', 'revokerole')->middleware('can:view-users');
    Route::get('/rolepermission/{id}', 'rolepermissions')->middleware('can:view-users');
});
Route::get('/logout' , function (){
    Auth::logout();
});



