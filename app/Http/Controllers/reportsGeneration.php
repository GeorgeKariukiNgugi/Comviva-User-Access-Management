<?php

namespace App\Http\Controllers;
use PDF;
use App\AccessLog;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class reportsGeneration extends Controller
{
    //
    public function gettingReportPage(){
        $companies = Company::all();        
        $roles = Auth::user()->getRoleNames();
        $numberOfRoles = count($roles);
        if ($numberOfRoles == 1) {
            # code...
            $roleForUser = null;
            foreach ($roles as $role) {
                # code...
                $roleForUser = $role;
            }


            switch ($roleForUser) {
                case 'accessmanager':
                    # code...                                        
                    return view('accessMangerInterfaces.reports',['company'=>$companies]);
                    break;
                    case 'admin':                                                
                        // return view('adminInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
                        return view('adminInterfaces.reports',['company'=>$companies]);
                    break;
                default:                
                return view('accessMangerInterfaces.reports',['company'=>$companies]);
                    # code...
                    break;
            }


        } else {
            # code...
            return back();
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }
    }

    public function postingAndGeneratingReports(Request $request){

        

        $from    = Carbon::parse($request->startDate)
                 ->startOfDay()       
                 ->toDateTimeString();

        $dateToFormat = date_create($request->startDate);
        $fromDate = date_format($dateToFormat, "D-d-F-Y H:i:s"); 

        $to      = Carbon::parse($request->endDate)
                        ->endOfDay()          // 2018-09-29 23:59:59.000000
                        ->toDateTimeString(); // 2018-09-29 23:59:59

        $dateToFormat = date_create($request->endDate);
        $endDate = date_format($dateToFormat, "D-d-F-Y H:i:s");

        if ($request->company == 0) {
            # code...
            $records  = AccessLog::whereBetween('timeIn', [$from, $to])
                                ->whereNotNull('TimeOut')  
                                ->get();
        } else {
            # code...
            $records  = AccessLog::whereBetween('timeIn', [$from, $to])
                                 ->whereNotNull('TimeOut')
                                 ->where('companyId',$request->company)
                                 ->get();
        }
        
        // $records  = AccessLog::whereBetween('timeIn', [$from, $to])->get();

        $pdf = PDF::loadView('sharedPages.pdfReport', compact('records','fromDate','endDate'))->setPaper('a4', 'landscape');
        return $pdf->download('name');

    }
}
