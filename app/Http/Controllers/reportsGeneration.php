<?php

namespace App\Http\Controllers;
use PDF;
use App\AccessLog;
use App\Company;
use Illuminate\Http\Request;
use Carbon\Carbon;

class reportsGeneration extends Controller
{
    //
    public function gettingReportPage(){
        $companies = Company::all();
        return view('accessMangerInterfaces.reports',['company'=>$companies]);
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
