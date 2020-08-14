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

//frontend routes auth routes ==============================================================

Auth::routes(['verify' => true]);
Route::get('/home/maininfo', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/clogout', function(){ if(Auth::check()){
            Auth::logout();
            return redirect()->route('login');
        }})->name('customlogout');
Route::get('/home/services', ['uses' => 'HomeController@Services', 'as' => 'home.services']);
Route::get('/home/links', ['uses' => 'HomeController@Links', 'as' => 'home.links']);
Route::get('/home/password', ['uses' => 'HomeController@Password', 'as' => 'home.password']);
Route::get('/home/user/services', ['uses' => 'HomeController@allServices', 'as' => 'home.user.services']);
Route::post('/getservices', ['uses' => 'HomeController@getServices', 'as' => 'getservices']);
Route::post('/saveservices', ['uses' => 'HomeController@saveServices', 'as' => 'saveservices']);
Route::post('/updateservices', ['uses' => 'HomeController@UpdateServices', 'as' => 'updateservices']);
//frontend non auth routes
Route::get('/', ['uses' => 'MainController@index', 'as' => 'main.page']);
Route::get('profile/{id}/{username}', ['uses' => 'MainController@profilePage', 'as' => 'profile.page']);

//update user profile
Route::post('home/user/profile','ProfileController@userProfileUpdate')->name('user.profile');
Route::post('/home/password/change','ProfileController@changePassword')->name( 'password.change');
Route::post('/home/social/link','ProfileController@socialLink')->name( 'social.link');
Route::post('/home/service/','ProfileController@addService')->name( 'add.service');
Route::get('/deleteservice/{id}', ['uses' => 'HomeController@DeleteServices', 'as' => 'deleteservices']);
Route::get('/home/user/gallary', ['uses' => 'ProfileController@Gallary', 'as' => 'gallary']);
Route::post('/home/user/gallarypost', ['uses' => 'ProfileController@GallaryPost', 'as' => 'gallarypost']);
Route::get('/home/user/deletegallary/{id}', ['uses' => 'ProfileController@GallaryDelete', 'as' => 'user.gallary.delete']);
Route::post('/home/user/deletegallarymultiple/', ['uses' => 'ProfileController@GallaryDeleteMultiple', 'as' => 'user.gallary.delete.multiple']);

//search
Route::get('/search','MainController@search')->name('search');
Route::post('/search','MainController@getServicesForSearch')->name('getservicessearch');

//pages
Route::get('/contact','MainController@Contact')->name('contact');
Route::post('/postcontact','MainController@PostContact')->name('postcontact');

Route::get('page/{slug}','MainController@Pagec')->name('page');

Route::post('/subpost','MainController@SubPosst')->name('subpost');



//admin routes==================================

//non auth routes
Route::prefix('admin')->namespace('admin')->middleware('admin')->group(function () {
    Route::get('/', ['as' => 'admin.login','uses'=>'AuthController@Login']);
    Route::post('/dologin', 'AuthController@DoLogin');
    });

//auth routs
Route::group(['prefix' => 'admin', 'namespace'=>'admin', 'middleware'=>'auth'], function () {
Route::get('/dashboard', 'HomeController@index')->name('admin.dashbaord');
Route::get('/adminlogout',['as' => 'admin.logout', 'uses' => 'HomeController@CustomLogout']);

//categories section routes
Route::get('/categories',['as'=> 'news.categories', 'uses'=>'HomeController@NewsCat']);
Route::post('/addnewscat',['as'=> 'news.add.cat', 'uses'=>'HomeController@addNewsCat']);
Route::get('/categories/{id}',['as'=> 'edit.news.categories', 'uses'=>'HomeController@editNewsCat']);
Route::post('/editnewscat',['as'=> 'news.edit.cat', 'uses'=>'HomeController@editNewsCatPost']);
Route::get('/deletenewscat/{id}',['as'=> 'delete.news.categories', 'uses'=>'HomeController@deleteNewsCatPost']);

//Services section

Route::get('/services',['as'=> 'list.services', 'uses'=>'HomeController@Services']);
Route::post('/servicespost',['as'=> 'add.services', 'uses'=>'HomeController@addServicePost']);
Route::get('/services/{id}',['as'=> 'edit.services', 'uses'=>'HomeController@editServices']);
Route::post('/editservicepost',['as'=> 'edit.servicepost', 'uses'=>'HomeController@editServicePost']);
Route::get('/deletservice/{id}',['as'=> 'delete.service', 'uses'=>'HomeController@deleteService']);

//custom forms
Route::get('/customforms/create',['as'=> 'custom.forms', 'uses'=>'HomeController@CustomForm']);
Route::post('/customforms/addpost',['as'=> 'custom.formspost', 'uses'=>'HomeController@CustomFormPost']);
Route::get('/customforms/delete{id}',['as'=> 'deletecustom.forms', 'uses'=>'HomeController@DeleteCustomForm']);
Route::post('/customforms/save',['as'=> 'savecustom.forms', 'uses'=>'HomeController@SaveCustomForm']);

//users
Route::get('/users/all',['as'=> 'all.users', 'uses'=> 'HomeController@AllUsers']);
Route::post('/users/addpost',['as'=> 'add.users.post', 'uses'=> 'HomeController@AddUsersPost']);
Route::get('/users/edit/{id}',['as'=> 'edit.users', 'uses'=> 'HomeController@EditUsers']);
Route::post('/users/editpost',['as'=> 'edit.users.post', 'uses'=> 'HomeController@EditUsersPost']);
Route::get('/users/deactive/{id}/{action}',['as'=> 'edit.users.deactive', 'uses'=> 'HomeController@ADUsers']);
Route::get('/users/details/{id}',['as'=> 'users.details', 'uses'=> 'HomeController@UserDetails']);
Route::get('/users/adminapprove/{id}',['as'=> 'users.admin.approve', 'uses'=> 'HomeController@UserAdminApprove']);
Route::get('/users/delete/{id}',['as'=> 'users.delete', 'uses'=> 'HomeController@UserDelete']);
// pending approvals
Route::get('/pending/approvals',['as'=> 'pending.users', 'uses'=> 'HomeController@PendingApprovals']);

Route::post('/featureduser',['as'=> 'userfeatured', 'uses'=> 'HomeController@Userfeatured']);

//serviceoptions
Route::get('/options/services_options',['as'=> 'list.servicesoptions', 'uses'=>'HomeController@ServicesOptions']);
Route::post('/options/serviceoptionspost',['as'=> 'add.servicesoption', 'uses'=>'HomeController@addServiceoptionPost']);
Route::get('/options/serviceoptions/{id}',['as'=> 'edit.serviceoptions', 'uses'=>'HomeController@editServiceOptions']);
Route::post('/options/editserviceoptionspost',['as'=> 'edit.serviceoptionspost', 'uses'=>'HomeController@editServiceOptionsPost']);
Route::get('/options/deletserviceoption/{id}',['as'=> 'delete.serviceoption', 'uses'=>'HomeController@deleteServiceOption']);


//settings
Route::get('/settings/all',['as'=> 'all.settings', 'uses'=> 'HomeController@AllSettings']);
Route::post('/settings/update',['as'=> 'update.settings', 'uses'=> 'HomeController@updateAppSettings']);

//pages
Route::get('/pages/contact',['as'=> 'page.contact', 'uses'=> 'HomeController@ContactPage']);
Route::post('/pages/contactpost',['as'=> 'page.contactpost', 'uses'=> 'HomeController@ContactPagePost']);

Route::get('/pages/terms',['as'=> 'page.terms', 'uses'=> 'HomeController@TermsPage']);
Route::post('/pages/termspost',['as'=> 'page.termspost', 'uses'=> 'HomeController@TermsPagePost']);

Route::get('/pages/privacy',['as'=> 'page.privacy', 'uses'=> 'HomeController@PrivacyPage']);
Route::post('/pages/privacypost',['as'=> 'page.privacypost', 'uses'=> 'HomeController@privacyPagePost']);

//subscribers
Route::get('/subscribers/all',['as'=> 'subscribers', 'uses'=> 'HomeController@Scribers']);
Route::get('/subscribers/{id}',['as'=> 'subscribersdelete', 'uses'=> 'HomeController@Scribersdelete']);

///end =========
});
