<?php
/**
 * Routes - all standard Routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */


/** Define static routes. */

// The default Routing
Route::get('/',       'Dashboard@index');
Route::get('/register',       'Registration@index');
Route::post('/adduser',       'Registration@addNewUser');
Route::post('/updateuser',       'Registration@updateUser');
Route::post('/changepass',       'Registration@changePassword');
Route::get('/login',       'Login@index');
Route::get('/adminlogin',       'Login@adminLoginView');
Route::post('/signin',       'Login@postlogin');
Route::post('/adminsign',       'Login@adminLogin');
Route::get('/dashboard',       'Dashboard@index');
Route::get('/play',       'Play@index');
Route::post('/addplayer',       'Play@addPlayer');
Route::get('/profile',       'Profile@index');
Route::get('/approve',       'Approve@index');
Route::get('/getdetail',       'Detail@index');
Route::get('/logout',       'Login@logout');
Route::get('/userpay',       'Pay@index');
Route::post('/allocate',       'Allocator@allocate');
Route::get('/cronrunner',      'Allocator@cronRunner');
Route::post('/ipaid',      'Pay@iPaid');
Route::post('/removevoid',      'Pay@removeVoided');
Route::post('/confirm',      'Pay@confirm');
Route::get('/activate',      'Activate@index');
Route::get('/mailer',      'Communicate@verifyEmail');


//Ajax calls
Route::post('/checkreferrer',      'Registration@checkReferrerExist');
Route::get('/payuser',       'Datatables@payUser');
Route::get('/voiduser',       'Datatables@voidedTrans');
Route::get('/activateuser',       'Datatables@activateUser');
Route::post('/ajaxactivate',      'Activate@activate');
/** End default Routes */