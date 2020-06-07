<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use RealRashid\SweetAlert\Facades\Alert;
class ManageCompanies extends Controller
{
    public function gettingManaeCompniesPage(){

        $companies = Company::all();
        return view('adminInterfaces.manageCompanies',['companies'=>$companies]);
    }
    public function deleteCompanies(Request $request){
        
        $companies = Company::where('id',$request->idOfCompay)->get();
        $nameOfCompany = null;
        foreach ($companies as $company) {
            # code...
            $nameOfCompany = $company->name;
            $company->delete();
        }
        Alert::success($nameOfCompany.'  Has Successfully been Deleted .', '');
        return back()->with('name',$nameOfCompany."Has Successfully been Deleted .");
    }
    public function editCompanies(Request $request){

        $companyEdited = Company::where('id',$request->idOfCompany)->get();

        foreach ($companyEdited as $company) {
            # code...
            $company->name = $request->name;
            $company->floor = $request->floor;
            $company->wing = $request->wing;
            $company->save();
        }
        Alert::success($company->name.'Has SuccessfullyBeen Edited.', '');
        return back()->with('added', $company->name.'Has SuccessfullyBeen Edited.');
    }

    public function addCompany(Request $request){

        $company = new Company();
        $company->name = $request->name;
        $company->floor = $request->floor;
        $company->wing = $request->wing;

        $company->save();
        Alert::success('A new Company Has Been Added With The name: '. $company->name, '');
        return back()->with('added', 'A new Company Has Been Added With The name: '. $company->name);
        
    }
}
