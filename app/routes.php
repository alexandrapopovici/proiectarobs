<?php
Route::any('/', 'SiteController@index');
Route::any('/contact', 'SiteController@contactUs');
Route::any('/about', 'SiteController@aboutUs');
Route::any('/signin', 'UserController@signin');
Route::any('/login', 'UserController@login');
Route::any('/confirmlogin', 'UserController@confirmLogin');
Route::any('/createuser', 'UserController@createUser');
Route::any('user/dashboard', 'UserController@dashboard');
Route::any('user/logout', 'UserController@logout');
Route::any('user/edit/{id}', 'UserController@editUser');
Route::any('user/visibleon/{id}', 'UserController@visibleon');
Route::any('user/visibleoff/{id}', 'UserController@visibleoff');
Route::any('user/visible', 'UserController@visibleUsers');
Route::any('user/birthdayusers', 'UserController@birthdayUsers');
Route::any('user/delete/{id}', 'UserController@deleteUser');
Route::any('user/changepassword/{id}', 'UserController@changePassword');
Route::any('user/newpassword', 'UserController@newPassword');
Route::any('message/create', 'MessageController@createMessage');
Route::any('message/confirm', 'MessageController@confirmMessage');
Route::any('message/inbox', 'MessageController@inboxMessages');
Route::any('message/sent', 'MessageController@sentMessages');
Route::any('message/unread', 'MessageController@unreadMessages');
Route::any('message/read/{id}', 'MessageController@readMessage');
Route::any('message/delete/{id}', 'MessageController@deleteMessage');
Route::any('user/remindpassword', 'RemindersController@getRemind');
Route::any('user/postremindpassword', 'RemindersController@postRemind');
Route::any('user/postresetpassword', 'RemindersController@postReset');


