<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\VisitorType;
use App\Company;
use App\CompanyEmployee;
use App\AccessLog;
class HomeController extends Controller
{
    use HasRoles;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // ! getting to see if the password has been changed. 

        // $superAdmin = Role::findByName('approvingmanager');
        // dd($superAdmin->users);
        $passwordChanged = Auth::user()->passwordChanged;

        if($passwordChanged == 0){

            // return "This is to be changed";
            return view('auth.changeInitialPassword');
        }
        $nameOfUser = Auth::user()->firstName.' '.Auth::user()->secondName;       
        $roles = Auth::user()->getRoleNames();   

        $nameOfUser = Auth::user()->firstName.' '.Auth::user()->secondName;
        if (Auth::user()->created_at == 'NULL') {
            # code...
            $dateToUser = "NULL";
        } else {
            # code...
            $dateToUser = date('d-m-Y', strtotime(Auth::user()->created_at));
        }
        
        // ! getting the type of visitors that are involved in the system. 

        $company = Company::all();
        $companyPointsPersons = CompanyEmployee::all();
        $typeOfVisitors = VisitorType::all();                   
        $numberOfRoles = count($roles);

        if ($numberOfRoles == 1) {

            $roleForUser = null;
            foreach ($roles as $role) {
                # code...
                $roleForUser = $role;
            }

            switch ($roleForUser) {
                // ! this is the case for the accessmanager.
                case 'accessmanager':
                    # code...                    
                    return view('accessMangerInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser,                                
                                'company'=>$company,'companyPointsPersons'=>$companyPointsPersons,'typeOfVisitors'=>$typeOfVisitors
                    ]);
                    break;

                    // ! this is the case for the admin.
                    case 'admin':                        
                        return view('adminInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser,
                        'company'=>$company,'companyPointsPersons'=>$companyPointsPersons,'typeOfVisitors'=>$typeOfVisitors
                        ]);
                    break;

                    // ! this is the case for the approvingManager.
                    case 'approvingmanager':
                        # code...
                        // ! getting the Id from companyEmployee table. 
                        $idOfEmployees = CompanyEmployee::where('usersId',Auth::user()->id)->get();
                        $idOfEmployee = null;
                        foreach($idOfEmployees as $employee){
                            $idOfEmployee =   $employee->id;       
                        }
                        
                        // ! getting the visitors awaiting approval.
                        $visitorsAwaitingApproval = AccessLog::where('employeeAttachedToId',$idOfEmployee)->get();                        
                        return view('approvingManager.landing')->with(['visitorsAwaitingApproval'=>$visitorsAwaitingApproval]);
                        

                        break;
                default:
                Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
                    # code...
                    break;
            }
        } else {
            Alert::danger(Auth::users()->firstName.'   '.Auth::users()->secondName.'  It Seems you are either Not Assigned A Role Or Multiple Roles, Contact Admin For Details.', '');
        }        
    }
}
