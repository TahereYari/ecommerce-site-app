<?php

use App\Http\Controllers\Admin\MessageAdminController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::prefix()->middleware('auth')->group(function () {
    
// });
//************************************************SiteController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('site', [App\Http\Controllers\Admin\SiteController::class, 'siteCreate'])->name('site_create');
    Route::post('siteInsert', [App\Http\Controllers\Admin\SiteController::class, 'siteInsert'])->name('site_insert');
    // Route::get('siteEdit', [App\Http\Controllers\Admin\SiteController::class, 'siteEdit'])->name('site_edit');
    Route::post('siteUpdate/{id}', [App\Http\Controllers\Admin\SiteController::class, 'siteUpdate'])->name('site_update');
  
    Route::post('/upload-image-site',[App\Http\Controllers\Admin\SiteController::class ,'uploadImageName'])->name('upload_image_site');
    Route::delete('/delete-image-site', [App\Http\Controllers\Admin\SiteController::class, 'deleteImage'])->name('delete.image.site');

});
//************************************************HomeAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('', [App\Http\Controllers\Admin\HomeAdminController::class, 'admin'])->name('admin');
    Route::get('/product_list', [App\Http\Controllers\Admin\HomeAdminController::class, 'products'])->name('product_list');
    Route::get('/roleList', [App\Http\Controllers\Admin\HomeAdminController::class, 'roleList'])->name('role_list');
    // Route::post('/message/read/{id}', [App\Http\Controllers\Admin\HomeAdminController::class, 'markAsRead'])->name('message.markAsRead');
    Route::get('/get-monthly-sales', [App\Http\Controllers\Admin\HomeAdminController::class, 'getMonthlySales'])->name('getMonthlySales');
});

//************************************************MessageAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
   Route::get('/allMessages',[App\Http\Controllers\Admin\MessageAdminController::class,'messageList'])->name('message_list');
    Route::post('/message/read/{id}', [App\Http\Controllers\Admin\MessageAdminController::class, 'markAsRead'])->name('message.markAsRead');

});

//************************************************RoleController********************************************** */

Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('/roleCreate', [App\Http\Controllers\Admin\RoleController::class, 'roleCreate'])->name('role_create');
    Route::post('/roleInsert', [App\Http\Controllers\Admin\RoleController::class, 'roleInsert'])->name('role_insert');
    Route::post('/roleUpdate/{id}', [App\Http\Controllers\Admin\RoleController::class, 'roleUpdate'])->name('role_update');
    Route::get('/roledelete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'roleDelete'])->name('role_delete');
});

//************************************************UserAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('/userList', [App\Http\Controllers\Admin\UserAdminController::class, 'userList'])->name('user_list');
    Route::get('/userCreate', [App\Http\Controllers\Admin\UserAdminController::class, 'userCreate'])->name('user_create');
    Route::post('/userInsert', [App\Http\Controllers\Admin\UserAdminController::class, 'userinsert'])->name('user_insert');
    Route::post('/userUpdate/{id}', [App\Http\Controllers\Admin\UserAdminController::class, 'userUpdate'])->name('user_update');
    Route::get('/userDelete/{id}',[App\Http\Controllers\Admin\UserAdminController::class ,'userDelete'])->name('user_delete');
    Route::get('/userProfile',[App\Http\Controllers\Admin\UserAdminController::class ,'user_profile'])->name('user_profile');
    Route::post('/profileUpdate',[App\Http\Controllers\Admin\UserAdminController::class ,'profileUpdate'])->name('profile_update');
    Route::post('/profileUpdatePass',[App\Http\Controllers\Admin\UserAdminController::class ,'profileUpdatePass'])->name('profile_updatePass');
    Route::get('/changePassword',[App\Http\Controllers\Admin\UserAdminController::class ,'changePassword'])->name('change_password');
    Route::post('/upload-image-user',[App\Http\Controllers\Admin\UserAdminController::class ,'uploadImageName'])->name('upload_image_user');
    Route::delete('/delete-image-user', [App\Http\Controllers\Admin\UserAdminController::class, 'deleteImage'])->name('delete.image.user');
   
});

//************************************************ProductAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    // Route::get('/productList', [App\Http\Controllers\Admin\ProductAdminController::class, 'productList'])->name('product_list');
    Route::get('/productCreate', [App\Http\Controllers\Admin\ProductAdminController::class, 'productCreate'])->name('product_create');
    Route::post('/productInsert', [App\Http\Controllers\Admin\ProductAdminController::class, 'productinsert'])->name('product_insert');
    Route::post('/productUpdate/{id}', [App\Http\Controllers\Admin\ProductAdminController::class, 'productUpdate'])->name('product_update');
    Route::get('/productDelete/{id}',[App\Http\Controllers\Admin\ProductAdminController::class ,'productDelete'])->name('product_delete');
    
    Route::post('/upload-video-endpoint',[App\Http\Controllers\Admin\ProductAdminController::class ,'uploadVideo'])->name('upload_video');
    Route::post('/upload-file-endpoint',[App\Http\Controllers\Admin\ProductAdminController::class ,'uploadFileName'])->name('upload_file');
    Route::post('/upload-image-endpoint',[App\Http\Controllers\Admin\ProductAdminController::class ,'uploadImageName'])->name('upload_image');

    Route::get('/get-license-details', [App\Http\Controllers\Admin\ProductAdminController::class ,'getLicenseDetails'])->name('get-license-details');
    Route::get('/showLicenses/{id}', [App\Http\Controllers\Admin\ProductAdminController::class ,'showLicenses'])->name('show_licenses');
    Route::get('/licenseDelete/{id}',[App\Http\Controllers\Admin\ProductAdminController::class ,'licenseDelete'])->name('license_delete');
    

    Route::delete('/delete-filePond-product', [App\Http\Controllers\Admin\ProductAdminController::class, 'deletefilePond'])->name('delete.filePond.product');
    Route::delete('/delete-imagePond-product', [App\Http\Controllers\Admin\ProductAdminController::class, 'deleteimagePond'])->name('delete.imagePond.product');
    Route::delete('/delete-videoPond-product', [App\Http\Controllers\Admin\ProductAdminController::class, 'deletevideoPond'])->name('delete.videoePond.product');


});


//************************************************CompetitionAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('/competitionList', [App\Http\Controllers\Admin\CompetitionController::class, 'competitionList'])->name('competition_list');
    Route::get('/competitionCreate', [App\Http\Controllers\Admin\CompetitionController::class, 'competitionCreate'])->name('competition_create');
    Route::post('/competitionInsert', [App\Http\Controllers\Admin\CompetitionController::class, 'competitionInsert'])->name('competition_insert');
    Route::post('/competitionUpdate/{id}', [App\Http\Controllers\Admin\CompetitionController::class, 'competitionUpdate'])->name('competition_update');
    Route::get('/competitionDelete/{id}',[App\Http\Controllers\Admin\CompetitionController::class ,'competitionDelete'])->name('competition_delete');
    Route::get('/competitionAnswers/{id}',[App\Http\Controllers\Admin\CompetitionController::class ,'competitionAnswers'])->name('competition_answers');
    Route::get('/competitionWiners/{id}',[App\Http\Controllers\Admin\CompetitionController::class , 'competitionWiners'])->name('competition_winers');
    Route::post('/competitionWiners/upload-file-compitetion', [App\Http\Controllers\Admin\CompetitionController::class, 'uploadFileName'])->name('upload_file_compitetion');
    Route::delete('/competitionWiners/delete-filePond-compitetion', [App\Http\Controllers\Admin\CompetitionController::class, 'deletefilePond'])->name('delete.filePond.compitetion');
    Route::post('/competitionWinersInsert', [App\Http\Controllers\Admin\CompetitionController::class, 'competitionWinersInsert'])->name('competition_winers_insert');
    
});

//************************************************CategoryAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
    Route::get('/categoryList', [App\Http\Controllers\Admin\CategoryController::class, 'categoryList'])->name('category_list');
    Route::get('/categoryCreate', [App\Http\Controllers\Admin\CategoryController::class, 'categoryCreate'])->name('category_create');
    Route::post('/categoryInsert', [App\Http\Controllers\Admin\CategoryController::class, 'categoryInsert'])->name('category_insert');
    Route::post('/categoryUpdate/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'categoryUpdate'])->name('category_update');
    Route::get('/categoryDelete/{id}',[App\Http\Controllers\Admin\CategoryController::class ,'categoryDelete'])->name('category_delete');
    Route::post('/upload-image-category',[App\Http\Controllers\Admin\CategoryController::class ,'uploadImageName'])->name('upload_image_category');
    Route::delete('/delete-image-category', [App\Http\Controllers\Admin\CategoryController::class, 'deleteImage'])->name('delete.image.category');

});

//************************************************RequestProductController********************************************** */

Route::prefix('/admin')->middleware(['auth','auth.role.admin'])->group(function () {
  
    Route::get('/requestList', [App\Http\Controllers\Admin\RequestProductController::class, 'requestList'])->name('request_list');
    Route::get('/update-status/{id}/{status}', [App\Http\Controllers\Admin\RequestProductController::class, 'updateStatus'])->name('update-status-request');

});
//************************************************LanguageAdminController********************************************** */
Route::prefix('/admin')->group(function () {
    Route::post('/switchLanguage/{lang}', [App\Http\Controllers\Admin\LanguageAdminController::class,'switchLanguage']);
    Route::get('/getLanguage', [App\Http\Controllers\Admin\LanguageAdminController::class,'getLanguage']);
});


//************************************************TicketAdminController********************************************** */

Route::prefix('/admin')->group(function () {
    Route::get('/ticketList', [App\Http\Controllers\Admin\TicketController::class, 'ticketList'])->name('ticket_list');
    Route::get('/ticketMessages/{id}', [App\Http\Controllers\Admin\TicketController::class, 'ticketMessages'])->name('ticket_messages');
    Route::get('/ticketMessages/read/{id}', [App\Http\Controllers\Admin\TicketController::class, 'markAsRead'])->name('ticket_read_messages');
    Route::post('/insertTicket', [App\Http\Controllers\Admin\TicketController::class, 'insertTicket'])->name('insert_ticket_admin');
});

//************************************************InvoiceController********************************************** */

Route::prefix('/admin')->group(function () {
    Route::get('/invoiceList', [App\Http\Controllers\Admin\InvoiceController::class, 'invoiceList'])->name('invoice_list');
    Route::get('/get-basket-products/{basketId}', [App\Http\Controllers\Admin\InvoiceController::class, 'getBasketProducts'])->name('get-basket-products');
   
});
//************************************************HomeAdminController********************************************** */
Route::prefix('/admin')->middleware(['auth', 'auth.role.admin'])->group(function () {
    Route::get('', [App\Http\Controllers\Admin\HomeAdminController::class, 'admin'])->name('admin');
    Route::get('/product_list', [App\Http\Controllers\Admin\HomeAdminController::class, 'products'])->name('product_list');
    Route::get('/roleList', [App\Http\Controllers\Admin\HomeAdminController::class, 'roleList'])->name('role_list');
    // Route::post('/message/read/{id}', [App\Http\Controllers\Admin\HomeAdminController::class, 'markAsRead'])->name('message.markAsRead');
    Route::get('/get-monthly-sales', [App\Http\Controllers\Admin\HomeAdminController::class, 'getMonthlySales'])->name('getMonthlySales');
});
//************************************************TicketFrontController********************************************** */

Route::prefix('/user')->group(function () {
    Route::post('/insertTicket', [App\Http\Controllers\Front\TicketController::class, 'insertTicket'])->name('insert_ticket');
    Route::get('/closeTicket/{id}', [App\Http\Controllers\Front\TicketController::class, 'closeTicket'])->name('close_ticket');
    Route::get('/allTickets', [App\Http\Controllers\Front\TicketController::class, 'allTickets'])->name('all_tickets');
    Route::get('/ticketView/{id}', [App\Http\Controllers\Front\TicketController::class, 'ticketView'])->name('ticket_view');
 
});




//************************************************HomeFrontController********************************************** */
// Route::get('/home', [App\Http\Controllers\Front\HomeFrontController::class, 'home'])->name('home');
Route::prefix('')->group(function () {
    Route::get('/', [App\Http\Controllers\Front\HomeFrontController::class, 'index'])->name('index');
    Route::get('/allProducts', [App\Http\Controllers\Front\HomeFrontController::class, 'allProducts'])->name('all_products');
    Route::get('/allFreeProducts', [App\Http\Controllers\Front\HomeFrontController::class, 'allFreeProducts'])->name('all_free_products');
    Route::get('/category/{id}', [App\Http\Controllers\Front\HomeFrontController::class, 'showByCategory'])->name('category.products');
    Route::post('/contactUs', [App\Http\Controllers\Front\HomeFrontController::class, 'contactUs'])->name('contact_us');
    Route::post('/competetionAnswer/{id}', [App\Http\Controllers\Front\HomeFrontController::class, 'competetionAnswer'])->name('competetion_answer');
    Route::get('/viewProduct/{id}', [App\Http\Controllers\Front\HomeFrontController::class, 'viewProduct'])->name('view_product');

    Route::post('/upload-file-answer', [App\Http\Controllers\Front\HomeFrontController::class, 'uploadFileName'])->name('upload_file_answer');
    Route::delete('/delete-filePond-answer', [App\Http\Controllers\Front\HomeFrontController::class, 'deletefilePond'])->name('delete.filePond.answer');
});

//************************************************UserFrontController********************************************** */

Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Front\UserFrontController::class, 'userDashboard'])->name('user_dashboard');
    Route::get('/profile', [App\Http\Controllers\Front\UserFrontController::class, 'profile'])->name('profile');
    Route::get('/ticket', [App\Http\Controllers\Front\UserFrontController::class, 'ticketPage'])->name('ticket_page');
    Route::post('/upload-file-endpoint',[App\Http\Controllers\Front\UserFrontController::class ,'uploadFileName'])->name('upload_file_user');
    Route::delete('/delete-filePond-user', [App\Http\Controllers\Front\UserFrontController::class, 'deletefilePond'])->name('delete.filePond.user');
    Route::post('/requestProduct', [App\Http\Controllers\Front\UserFrontController::class, 'requestProduct'])->name('request_product');
    Route::post('/profileUpdate', [App\Http\Controllers\Front\UserFrontController::class, 'profileUpdate'])->name('profile_update_user');
    Route::post('/profileUpdatePass', [App\Http\Controllers\Front\UserFrontController::class, 'profileUpdatePass'])->name('profile_changPass');
    Route::get('/myPurchases', [App\Http\Controllers\Front\UserFrontController::class, 'showPurchases'])->name('show_purchases');

});

//************************************************BasketController********************************************** */
Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/Insert/{user_id}/{product_id}/{license_id?}', [App\Http\Controllers\Front\BasketController::class, 'cartInsert'])->name('cartInsert');
    Route::get('/cartPage', [App\Http\Controllers\Front\BasketController::class, 'cartPage'])->name('cart_page');
    Route::get('/checkout/{basket_id}', [App\Http\Controllers\Front\BasketController::class, 'Checkout'])->name('Checkout');
    Route::get('/dekete/{basket_id}/{basketproduct_id}', [App\Http\Controllers\Front\BasketController::class, 'cartDelete'])->name('cartDelete');

});

//************************************************LanguageHomeController********************************************** */
Route::prefix('/home')->group(function () {
    Route::get('/switchLanguage/{lang}', [App\Http\Controllers\Front\HomeFrontController::class,'switchLanguage']);
    Route::get('/getLanguage', [App\Http\Controllers\Front\HomeFrontController::class,'getLanguage']);
});



Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
