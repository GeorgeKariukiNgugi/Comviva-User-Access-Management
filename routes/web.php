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

Route::get('/', function () {
    return view('masterLogIn');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ! this route is used to register users. 

Route::post('/registerVisitor', 'Visitors@RegisteringVisitors');

// ! this route is used to get the Regular Visitors. 

Route::get('/regularVisitor', 'Visitors@getRegularVisitors');

// ! this is the route that is used to post the visitors search. 

Route::post('/postVisitorSearch','Visitors@searchForVisitors');

// ! this route is used to post the visitors after searching. 

Route::post('/checkInVisitor','Visitors@checkInVisitor');

// ! this route is used to get the checking out page of vivitors. 

Route::get('/checkingOutUsers','Visitors@checkingOutVisitorsGetFunction');

Route::post('/checkingOutVisitor','Visitors@checkingOutVisitorPostFunction');

// ! this route is used to get the trends for the weeks.

Route::get('/trends','Visitors@gettingtrends');

// ! thi route is used to get the reports page.

Route::get('/reports','reportsGeneration@gettingReportPage');

// ! this route i sused to post and download the report. 

Route::post('/postingReport','reportsGeneration@postingAndGeneratingReports');

// ! this route is used to get the page on managing companies.

Route::get('/manageCompanies','ManageCompanies@gettingManaeCompniesPage');

// ! this is the route that will be used to delete the Companies.

Route::post('/deleteCompany','ManageCompanies@deleteCompanies');

// ! this route is used to add a company to the DB.

Route::post('/addCompany','ManageCompanies@addCompany');

// ! this route is used to edit the company details.

Route::post('/editCompany','ManageCompanies@editCompanies');

Route::get('/manageUsers','ManageUsers@managingUsers');

Route::post('/addNewUser','ManageUsers@addUser');

Route::post('/editUser','ManageUsers@editUser');

Route::post('/deleteuser','ManageUsers@deleteUsers');

Route::post('/resettingPassword','ManageUsers@changeInitialPassword');

Route::get('/manageCompanyPointsPersons','CompanyEmployeeController@index');

Route::post('/addCompanyPointsPerson','CompanyEmployeeController@store');

Route::post('/updateCompanyEmployee','CompanyEmployeeController@update');

Route::post('/deleteCompanyPointsPerson','CompanyEmployeeController@destroy');

Route::post('/approvingManagerApproval','ApprovingManager@approveVisitor');

Route::post('/denyManagerApproval','ApprovingManager@disapproveRequest');

Route::get('/previousRequests','ApprovingManager@previousRequests');

Route::get('/visitorsCheckedOut','Visitors@checkedOutVisitors');

Route::get('/changePassword','ManageUsers@getChangePassword');

Route::get('/sendSMS','SendSMS@sendSMS');


