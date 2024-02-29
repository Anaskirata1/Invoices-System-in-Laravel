<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicAchiveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


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

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', InvoicesController::class);

Route::resource('sections', SectionsController::class);

Route::resource('products', ProductsController::class);

Route::get('/section/{id}', [App\Http\Controllers\InvoicesController::class, 'getproducts'])->name('getproducts') ;

Route::get('/InvoicesDetails/{id}', [App\Http\Controllers\InvoicesDetailsController::class , 'edit']) ;

Route::get('View_file/{invoice_number}/{file_name}', [App\Http\Controllers\InvoicesDetailsController::class , 'open_file']);

Route::get('download/{invoice_number}/{file_name}', [App\Http\Controllers\InvoicesDetailsController::class , 'get_file']);

Route::post('delete_file', [App\Http\Controllers\InvoicesDetailsController::class , 'destroy'])->name('delete_file');

Route::get('/edit_invoice/{id}', [App\Http\Controllers\InvoicesController::class, 'edit']);

Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::get('/Status_show/{id}', [App\Http\Controllers\InvoicesController::class , 'show'])->name('Status_show');

Route::post('/Status_Update/{id}', [App\Http\Controllers\InvoicesController::class , 'Status_Update'])->name('Status_Update');

Route::get('Invoice_Paid', [App\Http\Controllers\InvoicesController::class , 'Invoice_Paid']) ;

Route::get('Invoice_UnPaid', [App\Http\Controllers\InvoicesController::class , 'Invoice_UnPaid']) ;

Route::get('Invoice_Partial', [App\Http\Controllers\InvoicesController::class , 'Invoice_Partial']) ;

Route::resource('Archive',  App\Http\Controllers\InvoicAchiveController::class);

Route::get('Print_invoice/{id}', [App\Http\Controllers\InvoicesController::class , 'Print_invoice']) ;

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles',RoleController::class);

    Route::resource('users',UserController::class);

    });
Route::get('invoices_report', [App\Http\Controllers\Invoices_Report::class , 'index']) ;

Route::post('Search_invoices', [App\Http\Controllers\Invoices_Report::class , 'Search_invoices']) ;

Route::get('customers_report', [App\Http\Controllers\Customers_Report::class , 'index'])->name("customers_report") ;

Route::get('Search_customers', [App\Http\Controllers\Customers_Report::class , 'Search_customers']) ;

Route::get('MarkAsRead_all', [App\Http\Controllers\InvoicesController::class , 'MarkAsRead_all'])->name('MarkAsRead_all') ;

Route::get('unreadNotifications_count', [App\Http\Controllers\InvoicesController::class , 'unreadNotifications_count'])->name('unreadNotifications_count') ;

Route::get('unreadNotifications', [App\Http\Controllers\InvoicesController::class , 'unreadNotifications'])->name('unreadNotifications') ;

Route::get('/{page}',[AdminController::class , 'index'] );
