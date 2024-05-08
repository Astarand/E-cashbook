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
use App\Country;
use App\City;


/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('pagenotfound', ['as' => 'notfound', 'uses' => 'HomeController@pagenotfound']);

Route::get('/', 'HomeController@index');
Route::get('/userlogin', 'HomeController@login');
Route::get('/logout', 'HomeController@logout');
Route::get('/signup', 'HomeController@register');
Route::get('/about-us', 'HomeController@about_us');
Route::post('/register/user', 'HomeController@registerUser');
Route::post('/login/user', 'HomeController@loginUser');
Route::get('/forgotpassword', 'HomeController@forgotpassword');
Route::post('/save_forgotpassword', 'HomeController@save_forgotpassword');
Route::get('/charterd', 'ChaterdController@index');
Route::get('/items', 'ItemsController@index');
Route::get('/additem', 'ItemsController@additem');
Route::get('/vendors', 'VendorController@index');
Route::get('/addvendor', 'VendorController@addvendor');
Route::post('/saveaddvendor', 'VendorController@saveaddvendor');
Route::get('/projects', 'ProjectController@index');
Route::get('/addproject', 'ProjectController@addproject');

//Designation Controller
Route::get('/designation', 'DesignationController@index');
Route::get('/adddesignation', 'DesignationController@adddesignation');
//End of Designation Controller

//Sales Controller
Route::get('/sales-invoice', 'SalesController@salesInvoiceIndex');
Route::get('/add-sales-invoice', 'SalesController@addSalesInvoice');
Route::get('/sales-credit-debit', 'SalesController@CreditDebitIndex');
Route::get('/add-sales-credit-debit', 'SalesController@addCreditDebit');
//End of Sales Controller

//Purchase Controller
Route::get('/purchase-invoice', 'PurchaseController@PurchaseInvoiceIndex');
Route::get('/add-purchase-invoice', 'PurchaseController@addPurchaseInvoice');
Route::get('/purchase-credit-debit', 'PurchaseController@CreditDebitIndex');
Route::get('/add-purchase-credit-debit', 'PurchaseController@addCreditDebit');
//End of Purchase Controller

//Asset Controller
Route::get('/assets', 'FixedAssetController@FixedAssetIndex');
Route::get('/addasset', 'FixedAssetController@addFixedAsset');
Route::get('/asset-voucher', 'FixedAssetController@AssetVoucherIndex');
Route::get('/add-asset-voucher', 'FixedAssetController@addAssetVoucher');
//End of Asset Controller

//Statutory Controller
Route::get('/statutory', 'StatutoryController@statutory');
Route::get('/editstatutory', 'StatutoryController@editstatutory');
//End of Statutory Controller

//Payment Controller
Route::get('/payment', 'PaymentController@index');
Route::get('/addpayment', 'PaymentController@addpayment');
Route::get('/viewmonthpayment', 'PaymentController@viewmonthpayment');
//End of Payment Controller

//Expenses Controller
Route::get('/expenses', 'ExpensesController@index');
Route::get('/addexpenses', 'ExpensesController@addexpenses');
Route::get('/viewmonthexpenses', 'ExpensesController@viewmonthexpenses');
//End of Expenses Controller

//Cash & Bank Controller
Route::get('/banks', 'CashController@BankIndex');
Route::get('/addbank', 'CashController@addBank');
Route::get('/bank-statement', 'CashController@BankStatement');
Route::get('/add-bank-transaction', 'CashController@AddBankTransaction');

Route::get('/loans', 'CashController@LoanIndex');
Route::get('/addloan', 'CashController@addLoan');
Route::get('/loan-statement', 'CashController@LoanStatement');
Route::get('/add-loan-installment', 'CashController@AddLoanInstallment');

Route::get('/cash', 'CashController@CashIndex');
Route::get('/add-cash-credit', 'CashController@CashCredit');
Route::get('/add-cash-debit', 'CashController@CashDebit');
//End of Cash & Bank Controller

Route::get('/getState', 'CompanyProfileController@getState');
Route::get('/getCity', 'CompanyProfileController@getCity');


//CA Panel

//Dashboard
Route::get('/cahome', 'CaHomeController@Index');
//CA Profile
Route::get('/caprofile', 'CaProfileController@Index');
//Client
Route::get('/client', 'ClientController@Index');
Route::get('/addclient', 'ClientController@AddClient');
Route::get('/client-view', 'ClientController@ClientDetails');
//Customer Assignment
Route::get('/customerassignment', 'CustomerAssignmentController@Index');
Route::get('/assignment-details', 'CustomerAssignmentController@AssignmentDetails');
//Employee
Route::get('/employee', 'EmployeeController@Index');
Route::get('/addemployee', 'EmployeeController@AddEmployee');
//Task
Route::get('/task', 'TaskController@Index');
Route::get('/addtask', 'TaskController@AddTask');
//Reminder
Route::get('/reminder', 'ReminderController@Index');
//Payments
Route::get('/capayments', 'CaPaymentsController@Index');
//Quote Set
Route::get('/quote', 'QuoteController@Index');
Route::get('/addquote', 'QuoteController@AddQuote');
//Agent
Route::get('/agent', 'AgentController@Index');
Route::get('/addagent', 'AgentController@AddAgent');
Route::get('/agent-view', 'AgentController@AgentDetails');






Auth::routes();
Route::group(['middleware' => ['auth']],function(){
	//Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/reset-password','ResetPasswordController@create');
	Route::post('/reset-password','ResetPasswordController@store')->name('reset.password.store');
	Route::get('/companyprofile', 'CompanyProfileController@index');
	Route::post('/update_compdet', 'CompanyProfileController@update_compdet');
	Route::post('/update_businessdet', 'CompanyProfileController@update_businessdet');
	Route::post('/update_bankdet', 'CompanyProfileController@update_bankdet');
	Route::post('/update_comp_attachment', 'CompanyProfileController@update_comp_attachment');
	Route::get('/customers', 'CustomerController@index');
	Route::get('/addcustomer', 'CustomerController@addcustomer');
	Route::post('/add_customer', 'CustomerController@add_customer');

	Route::get('/edit-customer/{custId}', 'CustomerController@edit_customer');
	Route::post('/update_customer', 'CustomerController@update_customer');
	Route::get('/view-customer/{custId}', 'CustomerController@view_customer');
	Route::get('changeStatus', 'CustomerController@changeStatus');
	Route::get('delCustomer', 'CustomerController@delCustomer');

	Route::post('/choose_ca', 'ChaterdController@choose_ca');
	Route::post('/register_ca', 'ChaterdController@register_ca');
	Route::get('/ca-requested', 'CaRequestController@index');
	Route::get('completeStatus', 'CaRequestController@completeStatus');
	Route::get('isEmailStatus', 'CaRequestController@isEmailStatus');
	Route::get('isWhatsappStatus', 'CaRequestController@isWhatsappStatus');
	Route::get('/our-ca', 'OurCaController@index');
	Route::get('/add-ca', 'OurCaController@add_ca');
	Route::get('/edit-ca/{caId}', 'OurCaController@edit_ca');
	Route::post('/update_ca', 'OurCaController@update_ca');
	Route::get('/updateCaStatus', 'OurCaController@updateCaStatus');
	Route::post('/register_our_ca', 'OurCaController@register_our_ca');
	Route::post('/assign_ca', 'ChaterdController@assign_ca');
	Route::post('/get_ca_set_permission', 'CaRequestController@get_ca_set_permission');

	Route::post('/save_add_item', 'ItemsController@save_add_item');
	Route::get('/edit-item/{itemId}', 'ItemsController@edit_item');
	Route::post('/update_item', 'ItemsController@update_item');
	Route::get('delItem', 'ItemsController@delItem');
	Route::get('/view-item/{itemId}', 'ItemsController@view_item');

	//added on 29-10-2023
	Route::post('/save_add_project', 'ProjectController@save_add_project');
	Route::get('/edit-project/{projId}', 'ProjectController@edit_project');
	Route::post('/update_project', 'ProjectController@update_project');
	Route::get('delProject', 'ProjectController@delProject');
	Route::get('/view-project/{projId}', 'ProjectController@view_project');
	Route::get('changeProjectStatus', 'ProjectController@changeProjectStatus');

	//added on 05-11-2023
	Route::post('/save_add_asset', 'FixedAssetController@save_add_asset');
	Route::get('/edit-asset/{assetId}', 'FixedAssetController@edit_asset');
	Route::post('/update_asset', 'FixedAssetController@update_asset');
	Route::get('delAsset', 'FixedAssetController@delAsset');
	Route::get('/view-asset/{assetId}', 'FixedAssetController@view_asset');

	Route::post('/save_add_voucher', 'FixedAssetController@save_add_voucher');
	Route::get('/edit-asset-voucher/{vId}', 'FixedAssetController@edit_asset_voucher');
	Route::get('/view-asset-voucher/{vId}', 'FixedAssetController@view_asset_voucher');
	Route::post('/update_voucher', 'FixedAssetController@update_voucher');
	Route::get('delAssetVoucher', 'FixedAssetController@delAssetVoucher');
	Route::post('/save_add_series_name', 'FixedAssetController@save_add_series_name');


});




Route::namespace("Admin")->prefix('admin')->group(function(){

	Route:: get('/','AdminController@index')->name('admin/home');

});



