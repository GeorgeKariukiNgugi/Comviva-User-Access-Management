<?php

namespace App\Http\Controllers;

use App\CompanyEmployee;
use App\Company;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CompanyEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //! showing the page. 

        $allEmployees = CompanyEmployee::all();
        $companies = Company::all();
        return view('adminInterfaces.manageCompanyPointsPerson')->with(['allEmployees'=>$allEmployees,'companies'=>$companies]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ! adding the company points person as a uer first. 
        $newUser = new User();
        $newUser->firstName = $request->firstName;
        $newUser->secondName = $request->secondName;
        $newUser->email = $request->email;
        $newUser->IdNo = $request->idNumber;
        $newUser->logIn_ip = '192.168.202.1';
        $newUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $newUser->passwordChanged  = 0;

        $newUser->save();
        $newUser->syncRoles(['approvingmanager']);
        
        // ! storing thw new company points person.         
        $companyPointsPerson = new CompanyEmployee();
        $companyPointsPerson->employeeName =  $request->firstName .'  '. $request->secondName;
        $companyPointsPerson->companyId = $request->company;
        $companyPointsPerson->usersId = $newUser->id;
        $companyPointsPerson->save();

        Alert::success("You Have Successfully Created A New Company Points Person $companyPointsPerson->employeeName");

        return back()->with('added',"You Have Successfully Created A New Company Points Person $companyPointsPerson->employeeName");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEmployee $companyEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyEmployee $companyEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //! this method is used to update the company Employee. 
        $companyEmployees = CompanyEmployee::where('id',$request->idOfUser)->get();

        foreach ($companyEmployees as $companyEmployee) {
            # code...
            $companyEmployee->employeeName = $request->name;
            $companyEmployee->companyId = $request->company;
            $companyEmployee->save();
        }

        Alert::success("You Have Successfully Edited  $companyEmployee->employeeName");
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanyEmployee  $companyEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //! deleting. 
        $companyEmployees = CompanyEmployee::where('id',$request->idOfUser)->get();
        $userId = null;
        foreach ($companyEmployees as $companyEmployee) {
            # code...
            $userId = $companyEmployee->usersId;
            $companyEmployee->delete();
        }

        $usersToDelete = User::where('id',$userId)->get();
        foreach ($usersToDelete as $user) {
            # code...
            $user->delete();
        }
        Alert::success("You Have Successfully Deleted.");

        return back();


    }
}
