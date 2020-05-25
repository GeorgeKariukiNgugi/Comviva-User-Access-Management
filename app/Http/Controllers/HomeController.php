<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

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

        Auth::user()->assignRole('accessmanager');

        $roles = Auth::user()->getRoleNames();        
        $nameOfUser = Auth::user()->firstName.' '.Auth::user()->secondName;
        if (Auth::user()->created_at == 'NULL') {
            # code...
            $dateToUser = "NULL";
        } else {
            # code...
            $dateToUser = date('d-m-Y', strtotime(Auth::user()->created_at));
        }
        
        
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
                    return view('accessMangerInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser]);
                    break;
                    case 'admin':                        
                        return view('adminInterfaces.landing',['name'=>$nameOfUser,'date'=>$dateToUser]);
                    break;
                default:
                    return Auth::user()->id;
                    # code...
                    break;
            }
        } else {
            return Auth::user()->id;
        }        
    }
}
