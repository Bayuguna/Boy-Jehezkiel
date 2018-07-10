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

// Route::get('/', function () {
// 	return view('home');
// });

Route::get('/divisi', function () {
	return view('auth.divisi');
});

Route::GET('/', 'IndexController@index');

Route::GET('/champion/{id}', 'IndexController@detailChampion');



// route authentication user
Auth::routes();

// route halaman home setelah login
Route::get('/home', 'HomeController@index')->name('home');

// route untuk user
Route::group(['prefix'=> 'user'], function (){
	Route::GET('/logout', 'Auth\LoginController@logoutUser')->name('user.logout');
	Route::GET('/schedule', 'UserScheduleController@userIndex')->name('user.schedule');
	Route::resource('message', 'UserMessageController');
	Route::GET('/message-out', 'UserMessageController@sentMsg')->name('user.message-out');
	Route::GET('/message-out/{id}', 'UserMessageController@seeMsg')->name('user.message-out-show');
	Route::POST('/message-out', 'UserMessageController@msgToAdmin')->name('user.message-store');
	Route::DELETE('/message-out/{id}', 'UserMessageController@deleteUserMsg');
});

// route untuk mengirim pesan dari guest yang dibuat di halaman home
Route::POST('/guest/message', 'GuestMessageController@store')->name('guest.message');

// route untuk melakukan update bukti pembayaran
Route::PUT('/team/update-payment/{team}', 'TeamController@updatePayment')->name('team.update-payment');

// route resource untuk tim
Route::resource('team', 'TeamController');

// route resource untuk member
Route::resource('member', 'MemberController');

// route resource untuk penjadwalan oleh admin
Route::resource('admin/schedule', 'ScheduleController');

// route untuk menambahkan lokasi pada pembuatan jadwal oleh admin
Route::POST('admin/location/add', 'ScheduleController@storeLocation')->name('admin.location-add');

// route untuk melakukan update pada lokasi pertandingan
Route::POST('admin/location/update/{admin}', 'ScheduleController@updateLocation')->name('admin.location-update');

// route group untuk admin
Route::group(['prefix' => 'admin'], function () {
	// route untuk mengakses dashboard admin
	Route::GET('/dashboard', 'AdminController@index')->name('admin.dashboard');
	// route untuk mengakses daftar tim yang telah mendaftar
	Route::GET('/team', 'AdminController@team')->name('admin.team');

	// route untuk mengakses detail tim yang telah medaftara
	Route::GET('/team/{id}', 'AdminController@detailTeam')->name('admin.team-detail');

	// route untuk mengakses anggota dari tim oleh admin
	Route::GET('/show-member/{id}', 'AdminController@show');

	//route untuk auth admin
	Route::POST('/login', 'Admin\LoginController@login')->name('admin.submit');
	Route::GET('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::GET('/logout', 'Admin\loginController@logout')->name('admin.logout');
	Route::POST('/password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::POST('/password/reset', 'Admin\ResetPasswordController@reset');
	Route::GET('/password/reset ', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::GET('/password/reset/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

	// route untuk menambahkan akun admin baru
	Route::POST('/register', 'AdminController@store')->name('admin.register');

	// route untuk melakukan update pada akun admin
	Route::PUT('/update-account/{admin}', 'AdminController@update')->name('admin.update-profile');

	// route untuk melakukan konfirmasi pembayaran yang telah dilakukan oleh tim oleh admin
	Route::PUT('/payment-confirm/{admin}', 'AdminController@paymentConfirm')->name('admin.payment-confirm');

	// route untuk membatalkan konfirmasi pembayaran yang telah dilakukan oleh tim oleh admin
	Route::PUT('/payment-unconfirm/{admin}', 'AdminController@paymentUnconfirm')->name('admin.payment-unconfirm');

	// route untuk melihat daftar akun admn
	Route::GET('/admin-account-list', 'AdminController@adminIndex')->name('admin.account-list');

	// route resource untuk message admin
	Route::resource('/message', 'MessageController');

	// route untuk mengakses daftar pesan keluar admin
	Route::GET('/message-out', 'MessageController@msgOut')->name('message.out');

	// route untuk mengakses detail pesan keluar admin
	Route::GET('/message-out/{id}', 'MessageController@viewMsgOut')->name('message.show-message-out');

	// route untuk mengakses daftar pesan yang dibuat oleh guest
	Route::GET('/message-guest', 'MessageController@msgGuestIndex')->name('message.message-guest');

	// route untuk mengakses detail pesan masuk guest
	Route::GET('/message-guest/{id}', 'MessageController@msgGuestShow');

	// route untuk menhapus pesan keluar admin
	Route::DELETE('/message-out/{id}', 'MessageController@deleteAdminMsgOut');

	// route untuk menghapus pesan dari guest oleh admin
	Route::DELETE('/message-guest/{id}', 'MessageController@deleteGuestMsg');

	// route untuk mengirim pesan dari view pesan guest
	Route::POST('/message-guest', 'MessageController@sendMsgInGuestView')->name('message.send-message-inGuest');

	// route untuk mengirim pesan dari view pesa keluar
	Route::POST('/message-out', 'MessageController@sendMsgInMsgOutView');

	// route untuk menagkses halaman jaura pada menu admin
	Route::GET('/champion', 'AdminController@champion')->name('admin.champion');

	// route untuk menambahkan juara
	Route::POST('/champion', 'AdminController@addChampion')->name('admin.add-champion');

	// route untuk untuk mengupdate juara
	Route::PUT('/champion/{id}', 'AdminController@updateChampion')->name('admin.update-champion');

	// route untuk menghapus juara
	Route::DELETE('/champion/{id}', 'AdminController@deleteChampion')->name('admin.delete-champion');

	// route untuk mengakses detail tim juara
	Route::GET('/champion/{id}', 'AdminController@detailChampion')->name('admin.detail-champion');

	// route untuk mengirim email ke guest
	Route::POST('/send', 'MailController@send')->name('message.send');
});
