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
Route::get('/edit-vendor/{vendorId}', 'VendorController@edit_vendor');
Route::post('/update_vendor', 'VendorController@update_vendor');
Route::post('/saveaddvendor', 'VendorController@saveaddvendor');
Route::get('/view-vendor/{vendorId}', 'VendorController@view_vendor');
Route::get('deleteVendor', 'VendorController@deleteVendor');

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

//End of Statutory Controller

//Payment Controller
Route::get('/payment', 'PaymentController@index');
Route::get('/addpayment', 'PaymentController@addpayment');
Route::get('/viewmonthpayment', 'PaymentController@viewmonthpayment');
Route::post('/savepayment', 'PaymentController@savepayment');
Route::get('/view-payment/{paymentId}', 'PaymentController@view_payment');
Route::get('/edit-payment/{payId}', 'PaymentController@edit_payment');
Route::get('/viewmonthpayment/{monthWise}/{custId}', 'PaymentController@viewmonthpayment');
Route::post('/update_payment', 'PaymentController@update_payment');
Route::get('delPayment', 'PaymentController@delPayment');
//End of Payment Controller

//Expenses Controller
Route::get('/expenses', 'ExpensesController@index');
Route::get('/addexpenses', 'ExpensesController@addexpenses');
Route::get('/viewmonthexpenses/{monthWise}/{added_by}', 'ExpensesController@viewmonthexpenses');
//End of Expenses Controller

//Cash & Bank Controller
Route::get('/banks', 'CashController@BankIndex');
Route::get('/addbank', 'CashController@addBank');
Route::get('/bank-statement', 'CashController@BankStatement');
Route::get('/add-bank-transaction', 'CashController@AddBankTransaction');

Route::get('/loans', 'CashController@LoanIndex');
Route::get('/addloan', 'CashController@addLoan');



Route::get('/cash', 'CashController@CashIndex');
Route::get('/add-cash-credit', 'CashController@CashCredit');
Route::get('/add-cash-debit', 'CashController@CashDebit');
//End of Cash & Bank Controller

Route::get('/getState', 'CompanyProfileController@getState');
Route::get('/getCity', 'CompanyProfileController@getCity');


//CA Panel

//CA Panel

//Dashboard
Route::get('/cahome', 'CaHomeController@Index');
//CA Profile
Route::get('/caprofile', 'CaProfileController@Index');
//Client
Route::get('/client', 'ClientController@Index');
Route::get('/addclient', 'ClientController@AddClient');
Route::get('/client-view/{custId}', 'ClientController@ClientDetails');
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
	
	//added on 11-11-2023
	Route::post('/save_sales_invoice', 'SalesController@save_sales_invoice');
	Route::get('/edit-sales-invoice/{sId}', 'SalesController@edit_sales_invoice');
	Route::get('/view-sales-invoice/{sId}', 'SalesController@view_sales_invoice');
	Route::post('/update_sales_invoice', 'SalesController@update_sales_invoice');
	Route::post('/sales_items_display', 'SalesController@sales_items_display');
	Route::post('/delSalesItem', 'SalesController@delSalesItem');
	Route::post('/update_sales_item', 'SalesController@update_sales_item');
	Route::post('/update_sales_item_quantity', 'SalesController@update_sales_item_quantity');
	Route::post('/update_sales_item_rate', 'SalesController@update_sales_item_rate');
	Route::post('/update_sales_invoice_final', 'SalesController@update_sales_invoice_final');
	Route::get('/delInvoice', 'SalesController@delInvoice');
	Route::get('/activateStatus', 'SalesController@activateStatus');
	
	//added on 12-11-2023
	Route::post('/save_sales_invoice_creditdebit', 'SalesController@save_sales_invoice_creditdebit');
	Route::get('/edit-sales-credit-debit/{sId}', 'SalesController@edit_sales_invoice_credit_debit');
	Route::get('/view-sales-credit-debit/{sId}', 'SalesController@view_sales_invoice_credit_debit');
	Route::post('/update_sales_invoice_creditdebit', 'SalesController@update_sales_invoice_creditdebit');
	Route::post('/sales_items_display_creditdebit', 'SalesController@sales_items_display_creditdebit');
	Route::post('/delSalesItemCreditDebit', 'SalesController@delSalesItemCreditDebit');
	Route::post('/update_sales_item_creditdebit', 'SalesController@update_sales_item_creditdebit');
	Route::post('/update_sales_item_quantity_creditdebit', 'SalesController@update_sales_item_quantity_creditdebit');
	Route::post('/update_sales_item_rate_creditdebit', 'SalesController@update_sales_item_rate_creditdebit');
	Route::post('/update_sales_invoice_final_creditdebit', 'SalesController@update_sales_invoice_final_creditdebit');
	Route::get('/delInvoiceCreditDebit', 'SalesController@delInvoiceCreditDebit');
	Route::get('/activateSalesCreditDebitStatus', 'SalesController@activateSalesCreditDebitStatus');
	Route::get('/paidInvCreditDebit', 'SalesController@paidInvCreditDebit');
	Route::get('/invoice-pdf/{id}', 'SalesController@getPdfSales');
	Route::get('/invoice-credit-debit-pdf/{id}', 'SalesController@getPdfSalesCreditDebit');
	
	
	Route::post('/save_purchase_invoice', 'PurchaseController@save_purchase_invoice');
	Route::get('/edit-purchase-invoice/{sId}', 'PurchaseController@edit_purchase_invoice');
	Route::get('/view-purchase-invoice/{sId}', 'PurchaseController@view_purchase_invoice');
	Route::post('/update_purchase_invoice', 'PurchaseController@update_purchase_invoice');
	Route::post('/purchase_items_display', 'PurchaseController@purchase_items_display');
	Route::post('/delPurchaseItem', 'PurchaseController@delPurchaseItem');
	Route::post('/update_purchase_item', 'PurchaseController@update_purchase_item');
	Route::post('/update_purchase_item_quantity', 'PurchaseController@update_purchase_item_quantity');
	Route::post('/update_purchase_item_rate', 'PurchaseController@update_purchase_item_rate');
	Route::post('/update_purchase_invoice_final', 'PurchaseController@update_purchase_invoice_final');
	Route::get('/delInvoicePurchase', 'PurchaseController@delInvoicePurchase');
	Route::get('/activateStatusPurchase', 'PurchaseController@activateStatusPurchase');
	Route::get('/purchase-invoice-pdf/{id}', 'PurchaseController@getPdfPurchase');
	
	Route::post('/save_purchase_invoice_creditdebit', 'PurchaseController@save_purchase_invoice_creditdebit');
	Route::get('/edit-purchase-credit-debit/{sId}', 'PurchaseController@edit_purchase_invoice_credit_debit');
	Route::get('/view-purchase-credit-debit/{sId}', 'PurchaseController@view_purchase_invoice_credit_debit');
	Route::post('/update_purchase_invoice_creditdebit', 'PurchaseController@update_purchase_invoice_creditdebit');
	Route::post('/purchase_items_display_creditdebit', 'PurchaseController@purchase_items_display_creditdebit');
	Route::post('/delPurchaseItemCreditDebit', 'PurchaseController@delPurchaseItemCreditDebit');
	Route::post('/update_purchase_item_creditdebit', 'PurchaseController@update_purchase_item_creditdebit');
	Route::post('/update_purchase_item_quantity_creditdebit', 'PurchaseController@update_purchase_item_quantity_creditdebit');
	Route::post('/update_purchase_item_rate_creditdebit', 'PurchaseController@update_purchase_item_rate_creditdebit');
	Route::post('/update_purchase_invoice_final_creditdebit', 'PurchaseController@update_purchase_invoice_final_creditdebit');
	Route::get('/delPurchaseCreditDebit', 'PurchaseController@delPurchaseCreditDebit');
	Route::get('/activatePurchaseCreditDebitStatus', 'PurchaseController@activatePurchaseCreditDebitStatus');
	Route::get('/paidPurchaseCreditDebit', 'PurchaseController@paidPurchaseCreditDebit');
	Route::get('/purchase-credit-debit-pdf/{id}', 'PurchaseController@getPdfPurchaseCreditDebit');
	
	//added on 25-11-2023
	Route::post('/save_expenses', 'ExpensesController@save_expenses');
	Route::get('/edit-expenses/{eId}', 'ExpensesController@edit_expenses');
	Route::get('/view-expenses/{eId}', 'ExpensesController@view_expenses');
	Route::post('/update_expenses', 'ExpensesController@update_expenses');
	Route::get('/getExpenseOptions', 'ExpensesController@getExpenseOptions');
	Route::get('/delExpenses', 'ExpensesController@delExpenses');
	
	Route::get('/statutory', 'StatutoryController@statutory');
	Route::get('/addstatutory', 'StatutoryController@addstatutory');
	Route::get('/editstatutory/{sId}', 'StatutoryController@editstatutory');
	Route::get('/viewstatutory/{sId}', 'StatutoryController@viewstatutory');
	Route::post('/save_statutory', 'StatutoryController@save_statutory');
	Route::post('/update_statutory', 'StatutoryController@update_statutory');
	
	Route::get('/chat-response/{caId}/{uid}/{id}', 'StatutoryController@chat_response');
	Route::post('/upload_file','MessageController@upload_file');
	Route::post('/insert_chat','MessageController@insert_chat');
	Route::post('/fetch_user_chat_history/{from_user_id}/{to_user_id}','MessageController@fetch_user_chat_history');
	
	//added on 02-12-2023
	Route::post('/save_bank', 'CashController@save_bank');
	Route::get('/edit-bank/{bankId}', 'CashController@edit_bank');
	Route::post('/update_bank', 'CashController@update_bank');
	Route::get('/bank-statement/{bankId}', 'CashController@BankStatement');
	Route::get('/add-bank-transaction/{loanId}', 'CashController@AddBankTransaction');
	Route::post('/save_transaction', 'CashController@save_transaction');

	Route::post('/save_loan', 'CashController@save_loan');
	Route::get('/edit-loan/{loanId}', 'CashController@edit_loan');
	Route::get('/loan-statement/{loanId}', 'CashController@LoanStatement');
	Route::post('/update_loan', 'CashController@update_loan');
	Route::post('/update_cashinhand', 'CashController@update_cashinhand');
	
	Route::get('/add-loan-installment/{loanId}', 'CashController@AddLoanInstallment');
	Route::post('/save_installment', 'CashController@save_installment');
	Route::get('/edit-installment/{loanId}', 'CashController@edit_installment');
	Route::get('/view-installment/{loanId}', 'CashController@view_installment');
	Route::post('/update_installment', 'CashController@update_installment');
	Route::get('/delInstallment', 'CashController@delInstallment');
	
	Route::post('/save_cash_credit', 'CashController@save_cash_credit');
	Route::post('/update_cash_credit', 'CashController@update_cash_credit');
	Route::get('/edit-cash-credit/{cId}', 'CashController@edit_cash_credit');
	Route::get('/view-cash-credit/{cId}', 'CashController@view_cash_credit');
	Route::post('/save_cash_debit', 'CashController@save_cash_debit');
	Route::post('/update_cash_debit', 'CashController@update_cash_debit');
	Route::get('/edit-cash-debit/{cId}', 'CashController@edit_cash_debit');
	Route::get('/view-cash-debit/{cId}', 'CashController@view_cash_debit');
	
	Route::get('/bank-statement-upload', 'CashController@bank_statement_upload');
	Route::post('/uploadBank_statement', 'CashController@uploadBank_statement');
	
	Route::get('/view-all-notification', 'NotificationController@index');
	
	//added on 16-12-2023
	Route::post('/update_comp_logo', 'CompanyProfileController@update_comp_logo');
	Route::post('/delete_comp_logo', 'CompanyProfileController@delete_comp_logo');
	
	Route::post('/update_comp_logo_ca', 'CaProfileController@update_comp_logo_ca');
	Route::post('/delete_comp_logo_ca', 'CaProfileController@delete_comp_logo_ca');
	Route::post('/update_compdet_ca', 'CaProfileController@update_compdet_ca');
	Route::post('/update_ca_speclization', 'CaProfileController@update_ca_speclization');
	Route::post('/update_bankdet_ca', 'CaProfileController@update_bankdet_ca');
	Route::post('/update_partner_ca', 'CaProfileController@update_partner_ca');
	Route::post('/update_ca_attachment', 'CaProfileController@update_ca_attachment');
	
	Route::get('/changeCustomerStatus', 'ClientController@changeCustomerStatus');
	Route::post('/clearNotification', 'NotificationController@clearNotification');
});




Route::namespace("Admin")->prefix('admin')->group(function(){

	Route:: get('/','AdminController@index')->name('admin/home');

});



