<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('exportexcel', "MainFormController@exportExcel")->name('exportexcel');
Route::middleware('prevent-back-history')->group(function (){

    Route::get('/clear-cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        
        return Redirect::back()->with('success', 'All cache cleared successfully.');
    });

    Route::group(['prefix' => 'admin'], function(){
        
        Auth::routes();

    });

    Auth::routes();

    Route::middleware('auth')->group(function(){
        
        
        Route::any('/forms/add/notes', 'MainFormController@addNotes')->name('forms.add.notes');
        Route::any('/forms/create', 'MainFormController@createForm')->name('forms.create');
        Route::any('/forms', 'MainFormController@index')->name('forms.index');
        Route::any('/form/view/{customer_id}', 'MainFormController@view')->name('form.view');
        Route::any('/form/edit/{customer_id}', 'MainFormController@edit')->name('form.edit');
        
        Route::get('/', 'HomeController@index')->name('user.home');
        Route::resource('users', 'UserController');
        Route::resource('role', 'RoleController');
        Route::get('/user/changeStatus/{id}','UserController@changeStatus')->name('user.changeStatus');
        Route::get('user/profile','UserController@profile')->name('user.profile');
        Route::get('user/update-profile','UserController@showUpdateProfileForm')->name('user.updateProfile');
        Route::post('user/update-profile','UserController@updateProfile')->name('user.updateProfile.submit');
        Route::get('user/change-password','UserController@changePasswordView')->name('user.changePassword');
        Route::post('user/change-password','UserController@changePassword')->name('user.changePassword.submit');
        
        Route::resource('email-queue', 'EmailQueueController');
        Route::get('get-main-data-view','MainFormController@getAddDataForm')->name('add.form.data');
        Route::post('save-extra-data','MainFormController@saveExtraData')->name('save.form.data.extra');
        Route::get('view-notes','MainFormController@viewNotes')->name('view.notes');
    });

    Route::group(['middleware' => ['auth', 'admin']], function(){
        
        Route::resource('users', 'UserController');
        Route::resource('estimators', 'EstimatorController');

    });
});
