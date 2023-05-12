<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Auth;
use \App\Http\Controllers\TeachersController;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\ClassController;
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


});
Route::controller(ClassController::class)->prefix('/class')->group(function (){
    Route::get('/' ,'index');
    Route::get('/view/{id}' , 'viewMore');
    Route::get('/view/classpage/{id}' , 'viewTeacherPage');//makes the user jump to the teacher page of the id
    Route::get('/view/studentpage/{id}' , 'viewStudentPage');//makes the user jump to the teacher page of the id
    Route::delete('view/deleteteacher/' , 'deleteTeacher');
    Route::get('view/updatestudentclass/{id}' , 'viewUpdatePage');

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
//fix the viewmore page on the details page


