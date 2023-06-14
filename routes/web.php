<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('layouts.home');
    
// });

Route::get('/check', function () {
    return view('connection');
    
});

Route::get('/clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    return "ok";
});


Route::get('/', 'Auth\LoginController@showLoginForm');

//Auth Related Controllers
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/verify', 'VerifyController@getVerify')->name('getverify');

Route::get('/resendVerifyCode', 'VerifyController@resendVerifyCode')->name('resendVerifyCode');

Route::post('/verify', 'VerifyController@postVerfiy')->name('verify');
Route::get('/verify/{token}', 'VerifyController@verifyUser')->name('verifyUser');

// change password
Route::get('/change_password','ChangePasswordController@ShowChangePassword');
Route::post('/change_password_form','ChangePasswordController@change_password_insert');


//Common Function Use
Route::get('/states/{country_code}', 'HomeController@states');
Route::get('/cities/{state_code}', 'HomeController@cities');
Route::get('/doc_download/{id}', 'HomeController@doc_download');
Route::get('membqual', 'HomeController@membqual');
Route::get('membdocs', 'HomeController@membdocs');

Route::get('/notification_read/{id}', 'HomeController@notification_read')->name('notification_read');

Route::post('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');

Route::get('article_show/{id}', 'BasicController@article_show')->name('article_show');
Route::get('category_show/{id}', 'BasicController@category_show')->name('article_show');

//for registration step2
Route::get('/membership', 'HomeController@membership');
Route::post('/college_dropdown', 'HomeController@college_dropdown');//dropdown college name
Route::post('/membership/store', 'HomeController@membership_store');

Route::get('/membership_address', 'HomeController@membershipAddress');
Route::post('/country_dropdown', 'HomeController@country_dropdown');
Route::post('/state_dropdown', 'HomeController@state_dropdown');
Route::post('/country_dropdown1', 'HomeController@country_dropdown1');
Route::post('/state_dropdown1', 'HomeController@state_dropdown1');
Route::post('/country_dropShow', 'HomeController@country_dropShow');



Route::post('/click_state_box', 'HomeController@click_state_box');
Route::post('/click_city_box', 'HomeController@click_city_box');

// country name for home page dashboard
Route::post('/country_code_name', 'HomeController@country_code_name');


Route::post('/membership/store_address', 'HomeController@store_address');
Route::get('/membership_address_update', 'HomeController@membershipAddressUpdate');
Route::post('/membership/update_address', 'HomeController@update_address');


Route::post('/CollegeNameTransfer', 'HomeController@CollegeNameTransferData');

Route::resource('/qualification', 'QualificationController');

Route::get('iap_membership_tenth', 'ServiceFormController@iap_membership_tenth');
Route::post('iap_membership_tenth_doc', 'ServiceFormController@iap_membership_tenth_doc');

Route::get('iap_membership_twelve', 'ServiceFormController@iap_membership_twelve');
Route::post('iap_membership_twelve_doc', 'ServiceFormController@iap_membership_twelve_doc');

Route::get('iap_membership_intern', 'ServiceFormController@iap_membership_intern');
Route::post('iap_membership_intern_doc', 'ServiceFormController@iap_membership_intern_doc');

Route::get('iap_membership_bpt', 'ServiceFormController@iap_membership_bpt');
Route::post('iap_membership_bpt_doc', 'ServiceFormController@iap_membership_bpt_doc');

Route::get('iap_membership_mpt', 'ServiceFormController@iap_membership_mpt');
Route::post('iap_membership_mpt_doc', 'ServiceFormController@iap_membership_mpt_doc');

Route::get('iap_membership_govprf1', 'ServiceFormController@iap_membership_govprf1');
Route::post('iap_membership_govprf1_doc', 'ServiceFormController@iap_membership_govprf1_doc');

Route::get('iap_membership_govprf2', 'ServiceFormController@iap_membership_govprf2');
Route::post('iap_membership_govprf2_doc', 'ServiceFormController@iap_membership_govprf2_doc');

Route::get('iap_membership_other', 'ServiceFormController@iap_membership_other');
Route::post('iap_membership_other_doc', 'ServiceFormController@iap_membership_other_doc');


// Admin Router start

Route::group(['middleware' => ['role:super_admin']], function() {
	    Route::resource('/admin', 'AdminController');

	   	Route::resource('/acl/user', 'ACL\UserController');
	   	Route::get('/acl/user/role/{id}','ACL\UserController@role');
	   	Route::post('/acl/user/role_assign','ACL\UserController@role_assign');
	   	Route::get('/acl/user/permission/{id}','ACL\UserController@permission');
	   	Route::post('/acl/user/permission_assign','ACL\UserController@permission_assign');
	   	Route::resource('/acl/role', 'ACL\RoleController');
	   	Route::resource('/acl/permission', 'ACL\PermissionController');
	});
	Route::group(['middleware' => ['role:super_admin|admin|member|member_admin|college|corporate']], function() {

		Route::group(['prefix' => 'approval'], function(){
			Route::get('qualification','ApprovalController@qualifications');
		   	Route::get('qualification/{id}','ApprovalController@qualification_show');
		   	Route::get('qualification_approve/{id}','ApprovalController@qualification_approve');
		   	Route::post('qualification_approve_all','ApprovalController@qualification_approve_all');
		   	
		   	Route::post('qualification_decline','ApprovalController@qualification_decline');
		   	Route::post('qualification_decline_all','ApprovalController@qualification_decline_all');

		   	Route::get('specialization','ApprovalController@specialization');
		   	Route::get('specialization/{id}','ApprovalController@specialization_show');
		   	Route::get('specialization_approve/{id}','ApprovalController@specialization_approve');
		   	Route::post('specialization_approve_all','ApprovalController@specialization_approve_all');

		   	Route::post('specialization_decline','ApprovalController@specialization_decline');
		   	Route::post('specialization_decline_all','ApprovalController@specialization_decline_all');
		   	
		   	
		   	Route::get('/profile/','ApprovalController@profile')->name('approval.profile');
		   	Route::get('/profile/{id}','ApprovalController@profile_show');
		   	Route::get('/profile_decline/{id}','ApprovalController@profile_decline');
		   	Route::get('/profile_approve/{id}','ApprovalController@profile_approve');
		   	Route::get('/profile_decline','ApprovalController@profile_decline');
		   	
		   	Route::get('service_request','ApprovalController@service_request');
		   	Route::post('service_request_filter','ApprovalController@service_request_filter');
		   	Route::get('/service_show/{id}','ApprovalController@service_show');
		   	Route::post('/service_approve','ApprovalController@service_approve');
		   	Route::post('/service_decline','ApprovalController@service_decline');
		   	Route::post('/payment_approve','ApprovalController@payment_approve');
		   	Route::post('/payment_declined','ApprovalController@payment_declined');
		   	Route::post('/assign_iap_no','ApprovalController@assign_iap_no');
		   	
		});
		
		Route::get('invoice','ServiceFormController@invoice_show');

		Route::resource('/service', 'ServiceController');
		Route::get('/members_list','ServiceController@members_list');
		Route::post('/members_list_fetch','ServiceController@members_list_fetch');
		Route::get('member/services/{id}','ServiceController@member_services');
		
		Route::get('/service/destroy/{id}', 'ServiceController@delete');
	    Route::get('/services_docs/{id}', 'ServiceController@services_docs');
	    Route::post('/member_document', 'ServiceController@member_document');
		
		Route::get('/service/coming_soon/{id}', 'ServiceFormController@coming_soon');
	    
		Route::get('/service/iap_membership/{id}', 'ServiceFormController@iap_membership');
		Route::get('service/iap_certificate_form/{id}','ServiceFormController@iap_certificate_form');
		Route::post('service/iap_certificate_form/store','ServiceFormController@iap_certificate_form_store');
		Route::post('/service/iap_membership/store', 'ServiceFormController@iap_membership_store');
		Route::get('/service/iap_membership_edit/{id}', 'ServiceFormController@iap_membership_edit');
		Route::patch('/service/iap_membership/update/{id}', 'ServiceFormController@iap_membership_update');
		
        Route::get('/new_members_list','ServiceController@new_members_list');
        Route::get('/new_members_list_detai/{id}','ServiceController@new_members_list_fetch');
        Route::post('/service_form_approve','ServiceController@service_profile_approve');
		Route::post('/service_form_decline','ServiceController@service_profile_decline');
        
		//documents
		// Route::group(['prefix' => 'services'], function(){
	    
	    		
		// Route::get('iap_membership_tenth', 'ServiceFormController@iap_membership_tenth');
		// Route::post('iap_membership_tenth_doc', 'ServiceFormController@iap_membership_tenth_doc');

		// Route::get('iap_membership_twelve', 'ServiceFormController@iap_membership_twelve');
		// Route::post('iap_membership_twelve_doc', 'ServiceFormController@iap_membership_twelve_doc');

		// Route::get('iap_membership_intern', 'ServiceFormController@iap_membership_intern');
		// Route::post('iap_membership_intern_doc', 'ServiceFormController@iap_membership_intern_doc');

		// Route::get('iap_membership_bpt', 'ServiceFormController@iap_membership_bpt');
		// Route::post('iap_membership_bpt_doc', 'ServiceFormController@iap_membership_bpt_doc');

		// Route::get('iap_membership_mpt', 'ServiceFormController@iap_membership_mpt');
		// Route::post('iap_membership_mpt_doc', 'ServiceFormController@iap_membership_mpt_doc');

		// Route::get('iap_membership_govprf1', 'ServiceFormController@iap_membership_govprf1');
		// Route::post('iap_membership_govprf1_doc', 'ServiceFormController@iap_membership_govprf1_doc');

		// Route::get('iap_membership_govprf2', 'ServiceFormController@iap_membership_govprf2');
		// Route::post('iap_membership_govprf2_doc', 'ServiceFormController@iap_membership_govprf2_doc');

		// Route::get('iap_membership_other', 'ServiceFormController@iap_membership_other');
		// Route::post('iap_membership_other_doc', 'ServiceFormController@iap_membership_other_doc');
		// });



		Route::get('/service/payment/{id}', 'ServiceFormController@service_payment');
		Route::post('/service/payment_now', 'ServiceFormController@payment_now');
		
		Route::get('service/photo_id_card/{id}','ServiceFormController@photo_id_card');
		Route::post('service/photo_id_card/store','ServiceFormController@photo_id_card_store');
		
	});

	Route::group(['middleware' => ['role:super_admin|admin']], function() {
		Route::resource('/article', 'Content\ArticleController');
		Route::get('/article/destroy/{id}', 'Content\ArticleController@delete');
		Route::post('/article/category_update', 'Content\ArticleController@category_update');
		
		Route::post('/article/update_order', 'Content\ArticleController@update_order');
	});
// Admin Route end

// Blog Route start

Route::prefix('blog')->group(function() {
    Route::get('/', 'BlogController@index');
});

// Blog Route end

// Category Route start

Route::group(['middleware' => ['role:super_admin|admin']], function() {
    Route::resource('/category', 'CategoryController');
    Route::post('/categoriesPosition', 'CategoryController@categoriesPosition');
    Route::resource('/tags', 'TagsController');
    Route::post('/topics_store', 'TagsController@topicsStore');

    Route::get('/link/create', 'CategoryController@create_link');
    Route::post('/link/store', 'CategoryController@store_link');
    Route::get('/link/{id}/edit', 'CategoryController@edit_link');
    Route::patch('/link/update/{id}', 'CategoryController@update_link');

});

// Category Route end

// Member Route start
Route::group(['middleware' => ['role:member']], function() {
    Route::resource('/member', 'MemberController');
    // Route::resource('/qualification', 'MemberControllers/QualificationController');
    Route::get('/qualification_reason/{id}', 'QualificationController@qualification_reason');
    Route::resource('/specialization', 'SpecializationController');
    Route::post('/specialization_reason', 'SpecializationController@specialization_reason');
});

Route::get('tenth_qualification','QualificationController@tenth_qual_show');
Route::post('tenth_qualification_create','QualificationController@tenth_qual_create');

Route::get('twelve_qualification','QualificationController@twelve_qual_show');
Route::post('tweleve_qualification_create','QualificationController@tweleve_qual_create');

Route::get('intern_qualification','QualificationController@intern_qual_show');
Route::post('intern_qualification_create','QualificationController@intern_qual_create');

Route::get('bpt_qualification','QualificationController@UG_qual_show');
Route::post('bpt_qualification_create','QualificationController@UG_qual_create');

Route::get('mpt_qualification','QualificationController@PG_qual_show');
Route::post('PG_qualification_create','QualificationController@PG_qual_create');

// Member Route end      

// Member Qualifiction Update start
Route::get('tenth_qual_update_show','QualificationController@tenth_qual_update_show');
Route::post('tenth_qualification_update/{id}','QualificationController@tenth_qual_update');

Route::get('twelve_qual_update_show','QualificationController@twelve_qual_update_show');
Route::post('twelve_qualification_update/{id}','QualificationController@twelve_qual_update');

Route::get('intern_qual_update_show','QualificationController@intern_qual_update_show');
Route::post('intern_qualification_update/{id}','QualificationController@intern_qual_update');

Route::get('undergraduate_qual_update_show','QualificationController@undergraduate_qual_update_show');
Route::post('undergraduate_qualification_update/{id}','QualificationController@undergraduate_qual_update');

Route::get('master_qual_update_show','QualificationController@master_qual_update_show');
Route::post('master_qualification_update/{id}','QualificationController@master_qual_update');
