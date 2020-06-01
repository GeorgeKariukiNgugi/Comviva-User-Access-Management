<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\visitorRegistration;
use App\Visitor;
use App\AccessLog;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Company;
use App\Charts\Charts;
class Visitors extends Controller
{
    // ! this function is used to handle the registering of new visitors.
    public function RegisteringVisitors(visitorRegistration $request ){

        // ! checking to see if the visitor is already logged In.

        $visitorPresent = Visitor::where('idNo',$request->idNumber)->get();

        if (count($visitorPresent) > 0) {
            $company = Company::all();   
            return redirect('/regularVisitor')->with(['company'=>$company,'searchResult'=>$visitorPresent, 'names'=>'The Visitor With The Id Of '. $request->idNumber. ' Has Been Registered, You Can Check Them Directly.']);
        }

        $visitor = new Visitor();
        $visitor->firstName =   $request->firstName;
        $visitor->secondName =  $request->secondName;
        $visitor->idNo =        $request->idNumber;        
        $visitor->address =     $request->address;

        // dd($request->visitorImage);
        if (($request->hasFile('visitorImage'))) {

            $name = pathinfo($request->file('visitorImage')->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = pathinfo($request->file('visitorImage')->getClientOriginalName(), PATHINFO_EXTENSION);
            $storageName = $name . time() . '.' . $extension;
            $request->file('visitorImage')->storeAs('public/VisitorImages', $storageName);
            $visitor->photoUrl =  'storage/VisitorImages/' . $storageName;
        }              
        $visitor->save();

        $loggingVisitor = new AccessLog();
        $loggingVisitor->visitorId = $visitor->id;
        $loggingVisitor->companyId= $request->company;
        $loggingVisitor->typeOfVisitorId= $request->typeOfVisitor;
        $loggingVisitor->timeIn= now();
        $loggingVisitor->approvedById = Auth::user()->id;

        $loggingVisitor->save();
        Alert::success($request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.', '');
        // Alert::toast( $request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.', 'success');
        return back()->with('status', $request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.');
    }

    public function getRegularVisitors(){

        return view('accessMangerInterfaces.regularVisitor');

    }

    // !this function is used to search for the regular visitors.
    public function searchForVisitors(Request $request){
        $company = Company::all();   
        $searchCreteria = $request->searchCreteria;
        // dd($searchCreteria);
        switch ($searchCreteria) {
            case 1:
                # code...
                $visitorSearchResult = Visitor::where('idNo',$request->searchText)->get();                 
                $nameValue = 'Results for search National Id of  '.$request->searchText;                         
                break;
            case 2:

                $visitorSearchResult = Visitor::where('firstName','like','%'.$request->searchText)
                                              ->orWhere('firstName','like',$request->searchText.'%')
                                              ->orWhere('firstName','like','%'.$request->searchText.'%')
                                              ->orWhere('secondName','like','%'.$request->searchText)
                                              ->orWhere('secondName','like',$request->searchText.'%')
                                              ->orWhere('secondName','like','%'.$request->searchText.'%')
                                              ->get();
                 $nameValue = ' Results for search  Name Id of  '.$request->searchText;                                                               
                break;
                # code...
                break;
            case 3:

                $visitorSearchResult = Visitor::where('address',$request->searchText)->get();
                $nameValue = ' Results for search  Address Id of  '.$request->searchText;                                           
                break;
                # code...
                break;

            
            default:
                # code...
                break;
        }        
        return back()->with(['searchResult'=>$visitorSearchResult,'names'=>$nameValue,'company'=>$company]);
    }

    public function checkInVisitor(Request $request){

        $checkingToSeeIfTheVisitorIsLoggedIn = AccessLog::where('visitorId',$request->idOfVisitor)->get();
        if (count($checkingToSeeIfTheVisitorIsLoggedIn) < 1) {

            $loggingVisitor = new AccessLog();
            $loggingVisitor->visitorId = $request->idOfVisitor;
            $loggingVisitor->companyId = $request->company;
            $loggingVisitor->typeOfVisitorId = $request->typeOfVisitor;
            $loggingVisitor->timeIn = now();
            $loggingVisitor->approvedById = Auth::user()->id;
    
            $loggingVisitor->save();

            // foreach ($checkingToSeeIfTheVisitorIsLoggedIn as $visitor) {
            //     # code...
            //     $nameOfLoggedVisitor = $visitor->accessLogBelongsToAtypeOfVisitor()->id;
            // }
            $nameOfLoggedVisitor = $loggingVisitor->accessLogBelongsToVisitor->firstName . '  '. $loggingVisitor->accessLogBelongsToVisitor->secondName;            
            Alert::success($nameOfLoggedVisitor.'   Visitor Has Successfully been Checked In.', '');
            return redirect('/home');
            
        } else {
            # code...
            Alert::warning(' The Visitor Has Already Been Logged In.', 'Click The Link At The Message Link To View More Details.');
            foreach ($checkingToSeeIfTheVisitorIsLoggedIn as $value) {
                # code...
                $details = $value;
            }
            return redirect('/home')->with(['details'=>$details]);
        }            
    }

    public function checkingOutVisitorsGetFunction(){
        $visitorsNotLoggedOut = AccessLog::whereNull('TimeOut')->get();
        return view('accessMangerInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
        
    }

    public function checkingOutVisitorPostFunction(Request $request){
        
        $checkingOutUsers = AccessLog::where('id',$request->idOfCheckedOutVisitor)->get();  
              foreach ($checkingOutUsers as $checkingOutUser) {
                  # code...
                  $nameOfUser = $checkingOutUser->accessLogBelongsToVisitor->firstName. '  '. $checkingOutUser->accessLogBelongsToVisitor->secondName;
                  $checkingOutUser->TimeOut = now();
                  $checkingOutUser->checkedOutById = Auth::user()->id;
                  $checkingOutUser->save();
              }
              Alert::success($nameOfUser.'   Visitor Has Successfully been Checked Out.', '');
              return back()->with('checkedOut','The Visitor  '.$nameOfUser. '  Has Successfully Been Checked out.');
    }

    public function gettingtrends(){
        
        $chart = new Charts;
        $chart->labels(['Jan', 'Feb', 'Mar']);
        $chart->dataset('Users by trimester', 'line', [10, 25, 13]);
        return view('accessMangerInterfaces.trends',['chart'=>$chart]);
    }
}
