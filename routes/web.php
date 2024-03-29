<?php

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

Route::get('/', 'HomeController@showHomePage')->name('index');
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/about', 'PageController@showAboutPage')->name('about');
Route::get('/contacts', 'PageController@showContactsPage')->name('contacts');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::group(['prefix' => '/forms', 'as' => 'forms.'], function () {
    Route::get('/{id}/view', 'FormController@viewFormPage')->name('view');
    Route::get('/{id}/download-results', 'FormResultsController@downloadResultsInPDF')
        ->name('results.download');

    Route::post('/submit', 'FormController@submitForm')->name('submit')
        ->middleware('duplicate.submit');
});

/* Dashboard Routes */
Route::group(['prefix' => '/dashboard', 'middleware' => ['auth.access:admin'], 'as' => 'dashboard.'], function () {
    Route::get('/', 'Dashboard\DashboardController')->name('home');

    Route::group(['prefix' => '/forms', 'as' => 'forms.'], function () {
        Route::get('/', 'Dashboard\FormController@showFormsListPage')->name('index');

        Route::get('/create', 'Dashboard\FormController@showCreateFormPage')->name('create');
        Route::post('/create', 'Dashboard\FormController@storeForm')->name('store');

        Route::post('/update', 'Dashboard\FormController@updateForm')->name('update');
        Route::post('/delete', 'Dashboard\FormController@deleteForm')->name('delete');

        Route::get('/{id}/edit', 'Dashboard\FormController@showEditFormPage')->name('edit');
        Route::get('/{id}/view', 'Dashboard\FormController@showViewResultsFormPage')->name('view');
    });

    Route::group(['prefix' => '/questions', 'as' => 'questions.'], function () {
        Route::post('/delete', 'Dashboard\FormQuestionController@deleteFormQuestion')
            ->name('delete');
    });

    Route::group(['prefix' => '/answer-variants', 'as' => 'answer_variants.'], function () {
        Route::post('/delete', 'Dashboard\AnswerVariantController@deleteAnswerVariant')
            ->name('delete');
    });
});