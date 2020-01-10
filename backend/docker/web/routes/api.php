<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/projects/{id?}', 'ProjectsController@index')->name('project.list')->middleware('cors');
Route::post('/projects/create', 'ProjectsController@store')->name('project.create')->middleware('cors');
Route::delete('/projects/delete/{id}', 'ProjectsController@delete')->name('project.delete')->middleware('cors');

Route::get('/employees', 'EmployeesController@index')->name('employee.list')->middleware('cors');
Route::get('/employees/{idProject}', 'EmployeesController@listAvaliable')->name('employee.avaliable.list')->middleware('cors');
Route::post('/employees/create', 'EmployeesController@store')->name('employee.create')->middleware('cors');
Route::delete('/employees/delete/{id}', 'EmployeesController@delete')->name('employee.delete')->middleware('cors');

Route::get('/project-employee/{idProject}', 'ProjectEmployeeController@index')->name('project-employee.list')->middleware('cors');
Route::post('/project-employee/create', 'ProjectEmployeeController@store')->name('project-employee.delete')->middleware('cors');
Route::delete('/project-employee/delete/{id}', 'ProjectEmployeeController@delete')->name('project-employee.delete')->middleware('cors');

