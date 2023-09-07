<?php

use Illuminate\Http\Request;
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

//  課程
Route::group(['namespace' => 'API', 'prefix' => 'course'], function () {
    // 取的課程列表
    Route::get('read', 'CourseController@index')->name('api.course.read');
    // 取得課程內容 *
    Route::get('show/{id}', 'CourseController@show')->name('api.course.show');
    // 新增課程
    Route::post('create', 'CourseController@store')->name('api.course.create');
    // 更新課程內容
    Route::put('update/{id}', 'CourseController@update')->name('api.course.update');
    // 刪除課程
    Route::delete('delete/{id}', 'CourseController@destroy')->name('api.course.delete');
});

//  講師
Route::group(['namespace' => 'API', 'prefix' => 'lecturer'], function () {
    // 取的講師列表
    Route::get('read', 'LecturerController@index')->name('api.lecturer.read');
    // 取得講師資料 *
    Route::get('show/{id}', 'LecturerController@show')->name('api.lecturer.show');
    // 新增講師
    Route::post('create', 'LecturerController@store')->name('api.lecturer.create');
    // 更新講師資料 *
    Route::put('update/{id}', 'LecturerController@update')->name('api.lecturer.update');
    // 刪除講師 *
    Route::delete('delete/{id}', 'LecturerController@destroy')->name('api.lecturer.delete');
    // 所有授課講師所開課程列表
    Route::get('lecturer-and-course-list', 'LecturerController@listAndCourse')->name('api.lecturer.list-and-course');
});