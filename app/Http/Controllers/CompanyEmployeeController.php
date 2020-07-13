<?php

namespace App\Http\Controllers;

use App\CompanyEmployee;
use App\Company;
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
        // ! storing thw new company points person. 

        $companyPointsPerson = new CompanyEmployee();
        $companyPointsPerson->employeeName =  $request->firstName .'  '. $request->secondName;
        $companyPointsPerson->companyId = $request->company;
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

        foreach ($companyEmployees as $companyEmployee) {
            # code...
            $companyEmployee->delete();
        }

        Alert::success("You Have Successfully Deleted.");

        return back();


    }
}
