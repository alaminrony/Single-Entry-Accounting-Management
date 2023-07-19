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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::get('email-test', function(){

    $details['email'] = 'alamin.onest@gmail.com';

    dispatch(new App\Jobs\SendEmailJob($details));

    dd('done');
});

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login');
Route::post('logout', 'LoginController@logout')->name('logout');
Route::get('forget-password', 'LoginController@forgetPass')->name('forgetPass');
Route::post('recovery-password', 'LoginController@recoveryPassword')->name('recoveryPassword');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    //User
    Route::get('myprofile', 'UserController@myprofile')->name('my.profile');
    Route::post('myprofile/edit','UserController@myprofileEdit')->name('my.profile.edit');

    Route::get('pending-cheque', 'PendingCheckController@index')->name('pendingCheque.index');
    Route::get('pending-cheque-filter', 'PendingCheckController@filter')->name('pendingCheque.filter');
    Route::post('pending-cheque/approve', 'PendingCheckController@approve')->name('pendingCheque.approve');
    Route::post('pending-cheque/delete', 'PendingCheckController@destroy')->name('pendingCheque.destroy');

    //Bank Management
    Route::get('bank-account-list', 'BankAccountController@index')->name('bankAccount.index');
    Route::get('bank-account-filter', 'BankAccountController@filter')->name('bankAccount.filter');
    Route::get('bank-account/create', 'BankAccountController@create')->name('bankAccount.create');
    Route::post('bank-account/store', 'BankAccountController@store')->name('bankAccount.store');
    Route::get('bank-account/{id}/view', 'BankAccountController@view')->name('bankAccount.view');
    Route::get('bank-account/{id}/edit', 'BankAccountController@edit')->name('bankAccount.edit');
    Route::patch('bank-account/{id}/update', 'BankAccountController@update')->name('bankAccount.update');
    Route::delete('bank-account/{id}/delete', 'BankAccountController@destroy')->name('bankAccount.destroy');
    //Head or Issue Management
    Route::get('head-list', 'IssueController@index')->name('head.index');
    Route::get('head-filter', 'IssueController@filter')->name('head.filter');
    Route::post('head-list/create', 'IssueController@create')->name('head.create');
    Route::post('head-list/store', 'IssueController@store')->name('head.store');
    Route::post('head-list/edit', 'IssueController@edit')->name('head.edit');
    Route::post('head-list/update', 'IssueController@update')->name('head.update');
    Route::delete('head-list/{id}/delete', 'IssueController@destroy')->name('head.destroy');

    //Bank Ledger Module
    Route::get('bank-ledger/{id}/list', 'BankLedgerController@index')->name('bankLedger.index');
    Route::post('bank-ledger/create', 'BankLedgerController@create')->name('bankLedger.create');
    Route::post('bank-ledger/store', 'BankLedgerController@store')->name('bankLedger.store');
    Route::post('bank-ledger/list', 'BankLedgerController@ledgerList')->name('bankLedger.ledgerList');
    Route::post('bank-ledger/edit', 'BankLedgerController@edit')->name('bankLedger.edit');
    Route::post('bankLedger/update', 'BankLedgerController@update')->name('bankLedger.update');
    Route::post('bank-ledger/delete', 'BankLedgerController@destroy')->name('bankLedger.destroy');

    //User
    Route::get('user', 'UserController@index')->name('user.index');
    Route::post('user/view', 'UserController@view')->name('user.view');
    Route::get('user-filter', 'UserController@filter')->name('user.filter');
    Route::get('user/{id}/transaction', 'UserController@transaction')->name('user.transaction');
    Route::post('user/create', 'UserController@create')->name('user.create');
    Route::post('user/store', 'UserController@store')->name('user.store');
    Route::post('user/edit', 'UserController@edit')->name('user.edit');
    Route::post('user/update', 'UserController@update')->name('user.update');
    Route::delete('user/{id}/delete', 'UserController@destroy')->name('user.destroy');

    //User role
    Route::get('user-role', 'UserRoleController@index')->name('role.index');
    Route::get('user-role-filter', 'UserRoleController@filter')->name('role.filter');
    Route::post('user-role/create', 'UserRoleController@create')->name('role.create');
    Route::post('user-role/store', 'UserRoleController@store')->name('role.store');
    Route::post('user-role/edit', 'UserRoleController@edit')->name('role.edit');
    Route::post('user-role/update', 'UserRoleController@update')->name('role.update');
    Route::delete('user-role/{id}/delete', 'UserRoleController@destroy')->name('role.destroy');

    //Report for account payable
    Route::get('account-payable', 'PayableController@index')->name('payable.index');
    Route::get('account-payable-filter', 'PayableController@filter')->name('payable.filter');
    Route::get('account-payable/{id}/details', 'PayableController@details')->name('payable.details');
    Route::get('account-payable/filter', 'PayableController@detailsFilter')->name('payable.detailsFilter');

    //Report for account receivable
    Route::get('account-receivable', 'ReceivableController@index')->name('receivable.index');
    Route::get('account-receivable-filter', 'ReceivableController@filter')->name('receivable.filter');
    Route::get('account-receivable/{id}/details', 'ReceivableController@details')->name('receivable.details');
    Route::get('account-receivable/filter', 'ReceivableController@detailsFilter')->name('receivable.detailsFilter');




    //Settings
    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::get('setting-filter', 'SettingController@filter')->name('setting.filter');
    Route::post('setting/create', 'SettingController@create')->name('setting.create');
    Route::post('setting/store', 'SettingController@store')->name('setting.store');
    Route::post('setting/edit', 'SettingController@edit')->name('setting.edit');
    Route::post('setting/update', 'SettingController@update')->name('setting.update');
    Route::delete('setting/{id}/delete', 'SettingController@destroy')->name('setting.destroy');


    //Visa Management
    Route::get('visa-entry', 'VisaEntryController@index')->name('visaEntry.index');
    Route::get('visa-entry-filter', 'VisaEntryController@VisaFilter')->name('visaEntry.VisaFilter');
    Route::get('visa-entry/create', 'VisaEntryController@create')->name('visaEntry.create');
    Route::post('visa-entry/generateCusCode', 'VisaEntryController@generateCusCode')->name('generateCusCode.create');
    Route::post('visa-entry/store', 'VisaEntryController@store')->name('visaEntry.store');
    Route::get('visa-entry/{id}/view', 'VisaEntryController@view')->name('visaEntry.view');
    Route::get('visa-entry/{id}/edit', 'VisaEntryController@edit')->name('visaEntry.edit');
    Route::post('visa-entry/{id}/update', 'VisaEntryController@update')->name('visaEntry.update');
    Route::delete('visa-entry/{id}/delete', 'VisaEntryController@destroy')->name('visaEntry.destroy');
    Route::get('visa-entry/{id}/transaction-list', 'VisaEntryController@transactionList')->name('visaEntry.transaction-list');
    Route::get('visa-entry/{id}/transaction-filter', 'VisaEntryController@filter')->name('visaEntry.filter');


    //Passport Management
    Route::get('passport-entry', 'PassportEntryController@index')->name('passportEntry.index');
    Route::get('passport-entry-filter', 'PassportEntryController@PassportFilter')->name('passportEntry.PassportFilter');
    Route::get('passport-entry/create', 'PassportEntryController@create')->name('passportEntry.create');
    Route::post('passport-entry/generateCusCode', 'PassportEntryController@generateCusCode')->name('passportEntry.generateCusCode');
    Route::post('passport-entry/store', 'PassportEntryController@store')->name('passportEntry.store');
    Route::get('passport-entry/{id}/view', 'PassportEntryController@view')->name('passportEntry.view');
    Route::get('passport-entry/{id}/edit', 'PassportEntryController@edit')->name('passportEntry.edit');
    Route::post('passport-entry/{id}/update', 'PassportEntryController@update')->name('passportEntry.update');
    Route::delete('passport-entry/{id}/delete', 'PassportEntryController@destroy')->name('passportEntry.destroy');
    Route::get('passport-entry/{id}/transaction-list', 'PassportEntryController@transactionList')->name('passportEntry.transaction-list');
    Route::get('passport-entry/{id}/filter', 'PassportEntryController@filter')->name('passportEntry.filter');


    //Medical Management
    Route::get('medical-entry', 'MedicalEntryController@index')->name('medicalEntry.index');
    Route::get('medical-entry-filter', 'MedicalEntryController@medicalFilter')->name('medicalEntry.medicalFilter');
    Route::get('medical-entry/create', 'MedicalEntryController@create')->name('medicalEntry.create');
    Route::post('medical-entry/generateCusCode', 'MedicalEntryController@generateCusCode')->name('medicalEntry.generateCusCode');
    Route::post('medical-entry/store', 'MedicalEntryController@store')->name('medicalEntry.store');
    Route::get('medical-entry/{id}/view', 'MedicalEntryController@view')->name('medicalEntry.view');
    Route::get('medical-entry/{id}/edit', 'MedicalEntryController@edit')->name('medicalEntry.edit');
    Route::post('medical-entry/{id}/update', 'MedicalEntryController@update')->name('medicalEntry.update');
    Route::delete('medical-entry/{id}/delete', 'MedicalEntryController@destroy')->name('medicalEntry.destroy');
    Route::get('medical-entry/{id}/transaction-list', 'MedicalEntryController@transactionList')->name('medicalEntry.transaction-list');
    Route::get('medical-entry/{id}/filter', 'MedicalEntryController@filter')->name('medicalEntry.filter');



    //Ticket Management
    Route::get('ticket-entry', 'TicketEntryController@index')->name('ticketEntry.index');
    Route::get('ticket-entry-filter', 'TicketEntryController@ticketFilter')->name('ticketEntry.ticketFilter');
    Route::get('ticket-entry/create', 'TicketEntryController@create')->name('ticketEntry.create');
    Route::post('ticket-entry/generateCusCode', 'TicketEntryController@generateCusCode')->name('ticketEntry.generateCusCode');
    Route::post('ticket-entry/store', 'TicketEntryController@store')->name('ticketEntry.store');
    Route::get('ticket-entry/{id}/view', 'TicketEntryController@view')->name('ticketEntry.view');
    Route::get('ticket-entry/{id}/edit', 'TicketEntryController@edit')->name('ticketEntry.edit');
    Route::post('ticket-entry/{id}/update', 'TicketEntryController@update')->name('ticketEntry.update');
    Route::delete('ticket-entry/{id}/delete', 'TicketEntryController@destroy')->name('ticketEntry.destroy');
    Route::get('ticket-entry/{id}/transaction-list', 'TicketEntryController@transactionList')->name('ticketEntry.transaction-list');
    Route::get('ticket-entry/{id}/filter', 'TicketEntryController@filter')->name('ticketEntry.filter');


    //Ticket Management
    Route::get('package-entry', 'PackageEntryController@index')->name('packageEntry.index');
    Route::get('package-entry-filter', 'PackageEntryController@packageFilter')->name('packageEntry.packageFilter');
    Route::get('package-entry/create', 'PackageEntryController@create')->name('packageEntry.create');
    Route::post('package-entry/generateCusCode', 'PackageEntryController@generateCusCode')->name('packageEntry.generateCusCode');
    Route::post('package-entry/store', 'PackageEntryController@store')->name('packageEntry.store');
    Route::get('package-entry/{id}/view', 'PackageEntryController@view')->name('packageEntry.view');
    Route::get('package-entry/{id}/edit', 'PackageEntryController@edit')->name('packageEntry.edit');
    Route::post('package-entry/{id}/update', 'PackageEntryController@update')->name('packageEntry.update');
    Route::delete('package-entry/{id}/delete', 'PackageEntryController@destroy')->name('packageEntry.destroy');
    Route::get('package-entry/{id}/transaction-list', 'PackageEntryController@transactionList')->name('packageEntry.transaction-list');
    Route::get('package-entry/{id}/filter', 'PackageEntryController@filter')->name('packageEntry.filter');


    //Bank Ledger Module
    Route::get('transaction-list', 'TransactionController@index')->name('transaction.index');
    Route::get('transaction-filter', 'TransactionController@filter')->name('transaction.filter');
    Route::post('voucher-entry/create', 'TransactionController@create')->name('transaction.create');
    Route::post('voucher-entry/getIssue', 'TransactionController@getIssue')->name('transaction.getIssue');
    Route::post('voucher-entry/store', 'TransactionController@store')->name('transaction.store');
    Route::get('voucher/{id}/view', 'TransactionController@view')->name('transaction.view');
    Route::post('voucher/edit', 'TransactionController@edit')->name('transaction.edit');
    Route::post('voucher/update', 'TransactionController@update')->name('transaction.update');
    Route::delete('voucher/{id}/delete', 'TransactionController@destroy')->name('transaction.destroy');

     // All Transaction List
    Route::get('report-transaction-list', 'ReportController@transactionList')->name('report.transactionList');
    Route::get('report-transaction-filter', 'ReportController@filter')->name('report.filter');
});

