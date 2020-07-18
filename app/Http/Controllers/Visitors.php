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
use Carbon\Carbon;
use App\VisitorType;
use App\CompanyEmployee;
use Spatie\Permission\Traits\HasRoles;
class Visitors extends Controller
{
    use HasRoles;
    // ! this function is used to handle the registering of new visitors.
    public function RegisteringVisitors(visitorRegistration $request ){

        // ! checking to see if the visitor is already logged In.
        $typeOfVisitors = VisitorType::all();
        $companyPointsPersons = CompanyEmployee::all();
        $visitorPresent = Visitor::where('idNo',$request->idNumber)->get();

        if (count($visitorPresent) > 0) {
            $company = Company::all();   
            return redirect('/regularVisitor')->with(['typeOfVisitors'=>$typeOfVisitors,'companyPointsPersons'=>$companyPointsPersons,'company'=>$company,'searchResult'=>$visitorPresent, 'names'=>'The Visitor With The Id Of '. $request->idNumber. ' Has Been Registered, You Can Check Them Directly.']);
        }

        $visitor = new Visitor();
        $visitor->firstName =   $request->firstName;
        $visitor->secondName =  $request->secondName;
        $visitor->idNo =        $request->idNumber;        
        $visitor->address =     $request->address;
        $visitor->mobile = $request->phoneNumber;
        

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
        $loggingVisitor->employeeAttachedToId = $request->pointsperson;
        $loggingVisitor->timeIn= now();
        $loggingVisitor->approvedById = Auth::user()->id;

        $loggingVisitor->save();
        Alert::success($request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.', '');
        // Alert::toast( $request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.', 'success');
        return back()->with('status', $request->firstName.'   '.$request->secondName.'  Has Successfully been Checked In.');
    }

    public function getRegularVisitors(){

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
                    return view('accessMangerInterfaces.regularVisitor');
                    break;
                    case 'admin':                        
                        return view('adminInterfaces.regularVisitor');
                    break;
                default:
                return view('accessMangerInterfaces.regularVisitor');
                    # code...
                    break;
            }


        } else {
            # code...
            return back();
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }
        
        

    }

    // !this function is used to search for the regular visitors.
    public function searchForVisitors(Request $request){
        $company = Company::all();   
        $typeOfVisitors = VisitorType::all();
        $companyPointsPersons = CompanyEmployee::all();        
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
        return back()->with(['typeOfVisitors'=>$typeOfVisitors,'companyPointsPersons'=>$companyPointsPersons,'searchResult'=>$visitorSearchResult,'names'=>$nameValue,'company'=>$company]);
    }

    public function checkInVisitor(Request $request){

        $checkingToSeeIfTheVisitorIsLoggedIn = AccessLog::where('visitorId',$request->idOfVisitor)
                                                        ->whereNull('TimeOut')
                                                        ->get();
        if (count($checkingToSeeIfTheVisitorIsLoggedIn) == 0) {

            $loggingVisitor = new AccessLog();
            $loggingVisitor->visitorId = $request->idOfVisitor;
            $loggingVisitor->companyId = $request->company;
            $loggingVisitor->typeOfVisitorId = $request->typeOfVisitor;
            $loggingVisitor->timeIn = now();
            $loggingVisitor->approvedById = Auth::user()->id;   
            $loggingVisitor->employeeAttachedToId = $request->companyPointsPerson; 
            $loggingVisitor->save();
           
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
                    return view('accessMangerInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
                    break;
                    case 'admin':                                                
                        return view('adminInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
                    break;
                default:                
                return view('accessMangerInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
                    # code...
                    break;
            }


        } else {
            # code...
            return back();
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }

        
        
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
        $chart->dataset('Users by trimester', 'bar', [10, 25, 13]);

        // ! creating the bar charts for each and every month of the year.

        $groupedCompanyBarChart = new Charts;
       

        $groupedTypeOfVisitorBarChart = new Charts;   

        $groupedBarChartForCompanyBasedOnMonths = new Charts;

        // ! getting companies . 
        $companies = Company::all();

        // ! getting visitor types. 



        $visitorTypes = VisitorType::all();
 //! forLoop to give colors. 

        $month = Carbon::now()->month;
        $number = $month;        

        // ! getting the looping number. 

        $loopingNumber = 0;
        if (count(Company::all()) > 12) {
            # code...
            $loopingNumber = count(Company::all());
        } else {
            # code...
            $loopingNumber = 12;
        }
        
        $borderColors = array();
        $fillColors = array();
        for ($j=0; $j < $loopingNumber+1; $j++) { 
            # code...

            $borderColor = "rgba(";                    
            for ($i=0; $i < 3 ; $i++) { 
                # code...  
                $random = rand(0,255);
            // dd($random);
                $borderColor.= $random;                        
                if ($i!=2) {
                    # code...
                    $borderColor.="," ;
                }
            }
            $fillColor = $borderColor.", 0.2)";
            $borderColor.=")";
            array_push($borderColors,$borderColor);
            array_push($fillColors,$fillColor);
        }
        for ($i=1; $i <= $number; $i++) { 
            # code...
            # code...            
            $companiesCount = array();
            $typeOfVisitorsCount = array();
            $companiesNames = array();
            $visitorsNames = array();

            if (count(AccessLog::whereMonth('timeIn',$i)->get()) < 1) {
                # code...
                    array_push($companiesCount,0);
                    array_push($companiesNames,'N/A');
                    array_push($typeOfVisitorsCount,0);
                    array_push($visitorsNames,'N/A');

            } else {
                

                foreach ($companies as $company) {
                    # code...
                    $monthRecords = AccessLog::whereMonth('created_at',$i)
                                             ->where('companyId',$company->id)    
                                            ->get();
                    $numberOfCompanyVisitsInMonth = count($monthRecords);
                    array_push($companiesCount,$numberOfCompanyVisitsInMonth);
                    array_push($companiesNames,$company->name);
                }
                
                

                foreach ($visitorTypes as $visitorType) {
                    # code...
                    $monthRecords = AccessLog::whereMonth('created_at',$i)
                                            ->where('typeOfVisitorId',$visitorType->id)    
                                            ->get();
                    $numberOfTypeOfVisitsInMonth = count($monthRecords);
                    array_push($typeOfVisitorsCount,$numberOfTypeOfVisitsInMonth);
                    array_push($visitorsNames,$visitorType->type);
                }                                                  
        }            

                    switch ($i) {
                        case 1:  
                            $month = 'January';                  
                        break;
                        case 2: 
                            $month = 'February';
                        break;
                        case 3: 
                            $month = 'March';
                        break;
                        case 4: 
                            $month = 'April';
                        break;
                        case 5: 
                            $month = 'May';
                        break;
                        case 6: 
                            $month = 'June';
                        break;
                        case 7: 
                            $month = 'July';
                        break;
                        case 8: 
                            $month = 'Aughust';
                        break;
                        case 9: 
                            $month = 'September';
                        break;
                        case 10: 
                            $month = 'October';
                        break;
                        case 11:
                            $month = 'November';
                        break;               
                        case 12: 
                            $month = 'December';
                        break;

                        default:
                            # code...
                            $month = '0000';
                            break;
                    }  
                    
                   
                    

                    
                    $groupedCompanyBarChart->dataset($month,'bar',$companiesCount)
                                            ->color($borderColors[$i])
                                            ->backgroundcolor($fillColors[$i]);

                    $groupedTypeOfVisitorBarChart->dataset($month,'bar',$typeOfVisitorsCount)
                    ->color($borderColors[$i])
                    ->backgroundcolor($fillColors[$i]);

                    $groupedCompanyBarChart->labels($companiesNames);
                    $groupedTypeOfVisitorBarChart->labels($visitorsNames);
        }
        
        // ! this ection is used to create the next set of graphs;

        foreach ($companies as $company) {
            # code...
            $numberOfVisitorsThatVisitedTheCompanyPerMonth = array();
            $monthsArray = array();
            for ($j=1; $j <= $number; $j++){
                
                $accessLogWithCompanyId = AccessLog::where('companyId','=',$company->id)
                                                    ->whereMonth('timeIn',$j)
                                                    ->get();
                if (count($accessLogWithCompanyId) == 0) {
                    # code...
                    // ! if tere is no record that is retrieved: 
                        array_push($numberOfVisitorsThatVisitedTheCompanyPerMonth,0.1);
                } else {
                    # code...
                    // ! if there are reords that are retrieved.
                    array_push($numberOfVisitorsThatVisitedTheCompanyPerMonth,count($accessLogWithCompanyId));
                }                  
                switch ($j) {
                    case 1:                          
                        array_push($monthsArray,'January');                
                    break;
                    case 2:                         
                        array_push($monthsArray,'February');  
                    break;
                    case 3:                         
                        array_push($monthsArray,'March');
                    break;
                    case 4: 
                        array_push($monthsArray,'April');                        
                    break;
                    case 5:                         
                        array_push($monthsArray,'May');
                    break;
                    case 6:                         
                        array_push($monthsArray,'June');
                    break;
                    case 7: 
                        array_push($monthsArray,'July');                        
                    break;
                    case 8: 
                        array_push($monthsArray,'Aughust');                        
                    break;
                    case 9: 
                        array_push($monthsArray,'September');                        
                    break;
                    case 10: 
                        array_push($monthsArray,'October');                        
                    break;
                    case 11:
                        array_push($monthsArray,'November');                        
                    break;               
                    case 12: 
                        array_push($monthsArray,'December');                        
                    break;

                    default:
                        # code...
                        $month = '0000';
                        break;
                }              
            }
            $groupedBarChartForCompanyBasedOnMonths->dataset($company->name,'bar',$numberOfVisitorsThatVisitedTheCompanyPerMonth)
            ->color($borderColors[$i])
            ->backgroundcolor($fillColors[$i]);
            $groupedBarChartForCompanyBasedOnMonths->labels($monthsArray);                        
        }

        // dd(Carbon::now()->month);

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
                    return view('accessMangerInterfaces.trends',['chart'=>$chart,'groupedTypeOfVisitorBarChart'=>$groupedTypeOfVisitorBarChart,'groupedCompanyBarChart'=>$groupedCompanyBarChart,'groupedBarChartForCompanyBasedOnMonths'=>$groupedBarChartForCompanyBasedOnMonths]);
                    break;
                    case 'admin':                                                
                        // return view('adminInterfaces.checkingOutVisitors')->with('visitors',$visitorsNotLoggedOut);
                        return view('adminInterfaces.trends',['chart'=>$chart,'groupedTypeOfVisitorBarChart'=>$groupedTypeOfVisitorBarChart,'groupedCompanyBarChart'=>$groupedCompanyBarChart,'groupedBarChartForCompanyBasedOnMonths'=>$groupedBarChartForCompanyBasedOnMonths]);
                    break;
                default:                
                return view('accessMangerInterfaces.trends',['chart'=>$chart,'groupedTypeOfVisitorBarChart'=>$groupedTypeOfVisitorBarChart,'groupedCompanyBarChart'=>$groupedCompanyBarChart,'groupedBarChartForCompanyBasedOnMonths'=>$groupedBarChartForCompanyBasedOnMonths]);
                    # code...
                    break;
            }


        } else {
            # code...
            return back();
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }
        
    }
    public function checkedOutVisitors(){

        $roles = Auth::user()->getRoleNames();
        $numberOfRoles = count($roles);
        if ($numberOfRoles == 1) {
            # code...
            $roleForUser = null;
            foreach ($roles as $role) {
                # code...
                $roleForUser = $role;
            }

            // ! getting the visitors checked out by date. 

            //! Visitors checked out today.
            $today = Carbon::today();
            $todayVisitorsCheckOuts = AccessLog::whereDate('timeIn',$today)->get();

            // ! visitors checked out yesterday. 
            $yesterday = Carbon::yesterday();
            $yesterdayVisitorsCheckOuts = AccessLog::whereDate('timeIn',$yesterday)->get();

            // ! visitors checked out this month.
            $month = $today->month;
            $thisMonthVisitors = AccessLog::whereMonth('timeIn',$month)->get();

            $visitorsArray = array();
            $visitorArrayHeader = array();
            array_push($visitorsArray,$todayVisitorsCheckOuts);
            array_push($visitorArrayHeader,'Visitors Today ('.$today->format('l jS \\of F Y').")");
            array_push($visitorsArray,$yesterdayVisitorsCheckOuts);
            array_push($visitorArrayHeader,'Visitors Yesterday. ('.$yesterday->format('l jS \\of F Y').")");
            array_push($visitorsArray,$thisMonthVisitors);
            array_push($visitorArrayHeader,'Visitors This Month. ('.$yesterday->format('F Y').")");
            // dd($visitorsArray);
            switch ($roleForUser) {
                case 'accessmanager':
                    # code...                                        
                         return view('accessMangerInterfaces.visitorsCheckedOut')->with(['visitorsArray'=>$visitorsArray,'visitorArrayHeader'=>$visitorArrayHeader]);
                    break;
                    case 'admin':                                                
                        return view('adminInterfaces.visitorsCheckedOut')->with(['visitorsArray'=>$visitorsArray,'visitorArrayHeader'=>$visitorArrayHeader]);
                    break;
                default:                
                        return view('accessMangerInterfaces.visitorsCheckedOut')->with(['visitorsArray'=>$visitorsArray,'visitorArrayHeader'=>$visitorArrayHeader]);
                    # code...
                    break;
            }


        } else {
            # code...
            return back();
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }

    }
}
