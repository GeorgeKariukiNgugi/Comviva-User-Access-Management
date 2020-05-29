<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\visitorRegistration;
use App\Visitor;
use App\AccessLog;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Company;
class Visitors extends Controller
{
    // ! this function is used to handle the registering of new visitors.
    public function RegisteringVisitors(visitorRegistration $request ){

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
                $nameValue = 'National Id of  '.$request->searchText;                         
                break;
            case 2:

                $visitorSearchResult = Visitor::where('firstName','like','%'.$request->searchText)
                                              ->orWhere('firstName','like',$request->searchText.'%')
                                              ->orWhere('firstName','like','%'.$request->searchText.'%')
                                              ->orWhere('secondName','like','%'.$request->searchText)
                                              ->orWhere('secondName','like',$request->searchText.'%')
                                              ->orWhere('secondName','like','%'.$request->searchText.'%')
                                              ->get();
                 $nameValue = 'Name Id of  '.$request->searchText;                                                               
                break;
                # code...
                break;
            case 3:

                $visitorSearchResult = Visitor::where('address',$request->searchText)->get();
                $nameValue = 'Address Id of  '.$request->searchText;                                           
                break;
                # code...
                break;

            
            default:
                # code...
                break;
        }        
        return back()->with(['searchResult'=>$visitorSearchResult,'names'=>$nameValue,'company'=>$company]);
    }

    public function checkInVisitor(){

    }
}
