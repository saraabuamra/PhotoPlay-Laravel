<?php

use App\Http\Controllers\API\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::controller(AuthController::class)->group(function(){
    Route::post('reset-password','ResetPassword')->name('resetPassword');
    Route::get('reset-password/{token}','ResetPasswordView')->name('reset-password');
    Route::get('success','Success')->name('success');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

    //Admin Login Route
    Route::match(['get', 'post'],'login','AdminController@login')->name('login');
    Route::group(['middleware' => ['admin']],function(){

            //Admin Dashboard Route
            Route::get('dashboard','AdminController@dashboard')->name('dashboard');

            //Admin Logout
            Route::get('logout','AdminController@logout')->name('logout');

            //Update Admin Password
            Route::match(['get','post'],'update-admin-password',
            'AdminController@updateAdminPassword')->name('update-admin-password');

            //Check Admin Password
            Route::post('check-admin-password',
            'AdminController@checkAdminPassword')->name('check-admin-password');

            //Update Admin Details
            Route::match(['get','post'],'update-admin-details',
            'AdminController@updateAdminDetails')->name('update-admin-details');

            //Sections
            Route::get('sections','SectionController@sections');

            //Update Section Status
            Route::post('update-section-status','SectionController@updateSectionStatus');

            //delete section
            Route::get('delete-section/{id}','SectionController@deleteSection');

            //add edit section
            Route::match(['get', 'post'],'add-edit-section/{id?}','SectionController@addEditSection');

            
             //Episodes
             Route::get('episodes','EpisodeController@episodes');

             //Update episode Status
             Route::post('update-episode-status','EpisodeController@updateEpisodeStatus');
     
             //delete episode
             Route::get('delete-episode/{id}','EpisodeController@deleteEpisode');
     
             //add edit episode
             Route::match(['get', 'post'],'add-edit-episode/{id?}','EpisodeController@addEditEpisode');

             //delete episode video
             Route::get('delete-episode-video/{id}','EpisodeController@deleteEpisodeVideo');

        

            //Movies
            Route::get('movies','MovieController@movies');

            //Update Movie Status
            Route::post('update-movie-status','MovieController@updateMovieStatus');

            //delete movie
            Route::get('delete-movie/{id}','MovieController@deleteMovie');

            //add edit movie
            Route::match(['get', 'post'],'add-edit-movie/{id?}','MovieController@addEditMovie');

            //delete movie image
            Route::get('delete-movie-image/{id}','MovieController@deleteMovieImage');


            //Actors
            Route::get('actors','ActorController@actors');

            //Update Actor Status
            Route::post('update-actor-status','ActorController@updateActorStatus');

            //delete actor
            Route::get('delete-actor/{id}','ActorController@deleteActor');

            //add edit actor
            Route::match(['get', 'post'],'add-edit-actor/{id?}','ActorController@addEditActor');

            //delete actor image
            Route::get('delete-actor-image/{id}','ActorController@deleteActorImage');

            //chart user
            Route::get('chart', 'ChartJSController@index');

            //settings about-and-help
            Route::get('about-and-help', 'SettingController@aboutAndHelp')->name('about-and-help');
        
    });

});

