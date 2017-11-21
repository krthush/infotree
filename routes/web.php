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

Auth::routes();



/* Welcome Routes */
Route::get('/', 'WelcomeController@welcome')->name('welcome');



/* Home Controller Routes */
Route::get('/home', 'HomeController@index')->name('home');



/* Devblog */
Route::get('/devblog', function() {
	return view('devblog');
})->name('devblog');



/* Logout */
Route::get('/logout', 'Auth\LogoutController@destroy');



/* Account Activation Routes */
Route::get('account/activate/{token}','Auth\ActivationController@activate')->name('account.activate');
Route::get('account/activation/request','Auth\ActivationController@request')->name('account.activation.request');
Route::post('account/resend/activation','Auth\ActivationController@resend')->name('account.activation.resend');



/* About */
Route::get('/about', function() {
	return view('about');
})->name('about');



/* Legal */
Route::get('/legal', function() {
	return view('legal');
})->name('legal');
Route::get('/license', function() {
	return view('license');
})->name('license');



/* Master Emails */
Route::get('/emails','EmailController@show')->name('emails');
Route::post('/add-alpha','EmailController@alpha');
Route::post('/add-admin','EmailController@add');
Route::post('/remove-admin','EmailController@remove');
Route::post('/ban','EmailController@ban');
Route::post('/unban','EmailController@unban');



/* Tree Routes */
Route::get('/mytree','TreeController@mytree')->name('mytree');
Route::get('/trees', 'TreeController@all')->name('trees');
Route::get('/tree/{tree}','TreeController@show')->name('tree');
Route::post('/tree/new-tree','TreeController@store')->name('new-tree');
Route::post('/{tree}/clone-tree','TreeController@clone')->name('clone-tree');
Route::post('/{tree}/add-tree','TreeController@add')->name('add-tree');
Route::delete('/tree/delete-tree','TreeController@destroy')->name('delete-tree');
Route::patch('/{tree}/favourite-tree','TreeController@favourite')->name('favourite-tree');
Route::patch('/{tree}/share-tree','TreeController@share')->name('share-tree');
Route::patch('/{tree}/description-tree','TreeController@desc')->name('description-tree');
Route::patch('/{tree}/rename-tree','TreeController@updateName')->name('rename-tree');



/* Branch Routes */
Route::get('/{tree}/add-branch','BranchController@create')->name('add-branch');
Route::post('/{tree}/add-branch','BranchController@store');
Route::get('/{tree}/delete-branch','BranchController@delete')->name('delete-branch');
Route::delete('/{tree}/delete-branch','BranchController@destroy');
Route::get('/{tree}/move-branch','BranchController@move')->name('move-branch');
Route::patch('/{tree}/move-branch','BranchController@update');
Route::get('/{tree}/rename-branch','BranchController@rename')->name('rename-branch');
Route::patch('/{tree}/rename-branch','BranchController@updateName');



/* Leaf Routes */
Route::get('/branches/{branch}','LeafController@show');
Route::patch('/branches/{branch}','LeafController@update');
Route::post('/branches/{branch}/leaves','LeafController@store');
Route::delete('/branches/{branch}/leaves','LeafController@destroy')->name('delete-leaf');



/* Like Routes */
Route::get('/{tree}/like-tree', 'LikeController@likeTree')->name('like-tree');



/* Test Route */
Route::get('/test', function() {
	return view('test');
});