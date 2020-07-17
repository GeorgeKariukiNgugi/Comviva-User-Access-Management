<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AccessLog;
use RealRashid\SweetAlert\Facades\Alert;
use App\CompanyEmployee;
use Auth;
class ApprovingManager extends Controller
{
    // ! approving a visitor for a visit. 
    public function approveVisitor(Request $request){

        $approvedVisitors = AccessLog::where('id',$request->idOfApproval)->get();
        foreach ($approvedVisitors as $approvedVisitor) {
            # code...
            $approvedVisitor->approvingManagerApproval = 1;
            $approvedVisitor->save();
        }
        Alert::success("REQUEST APPROVED.");
        return back()->with(['message'=>'Approved The Request.']);
    }

    public function disapproveRequest(Request $request){
        $approvedVisitors = AccessLog::where('id',$request->idOfApproval)->get();
        foreach ($approvedVisitors as $approvedVisitor) {
            # code...
            $approvedVisitor->approvingManagerApproval = -1;
            $approvedVisitor->save();
        }
        Alert::warning("REQUEST DENIED.");
        return back()->with(['message'=>'Denied The Request.']);
    }

    public function previousRequests(){

        $companyEmployeeIds = CompanyEmployee::where('usersId',Auth::user()->id)->get();
        $companyId = null;
        foreach ($companyEmployeeIds as $companyEmployeeId) {
            # code...
            $companyId = $companyEmployeeId->id;
        }
        $previous = AccessLog::where('employeeAttachedToId',$companyId)->get();

        return view('approvingManager.previousVisitors')->with(['previous'=>$previous]);

    }

}
