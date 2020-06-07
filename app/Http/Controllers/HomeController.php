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
        // $role = Role::create(['name' => 'admin']);
        // Auth::user()->assignRole('admin');


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

        // $typeOfCompanyName = array();
        // $typeOfCompanyId = array();
        $company = Company::all();                
        // foreach ($company as $company) {
        //     # code...
        //     array_push($typeOfCompanyName,$company->name);
        //     array_push($typeOfCompanyId,$company->id);
        // }



        $numberOfRoles = count($roles);

        if ($numberOfRoles == 1) {

            $roleForUser = null;
            foreach ($roles as $role) {
                # code...
                $roleForUser = $role;
            }

            switch ($roleForUser) {
                case 'accessmanager':
                    # code...                    
                    return view('accessMangerInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser,                                
                                'company'=>$company
                    ]);
                    break;
                    case 'admin':                        
                        return view('adminInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser,
                        'company'=>$company
                        ]);
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
