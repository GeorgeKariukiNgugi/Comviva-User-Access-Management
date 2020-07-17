<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Auth;
class ManageUsers extends Controller
{
    public function managingUsers(){


        $users = User::all();
        // ! getting the roles from the DB.
        $roles =  DB::table('roles')->get();
        return view('adminInterfaces.manageUsers')->with(['users'=>$users,'roles'=>$roles]);
    }

    public function addUser(Request $request){
        $newUser = new User();
        $newUser->firstName = $request->firstName;
        $newUser->secondName = $request->secondName;
        $newUser->email = $request->email;
        $newUser->IdNo = $request->idNumber;
        $newUser->logIn_ip = '192.168.202.1';
        $newUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $newUser->passwordChanged  = 0;

        $newUser->save();

        $newUser->syncRoles([$request->roles]);
        Alert::success($newUser->firstName .' '.$newUser->secondName.'Has SuccessfullyBeen Added.', '');
        return back()->with('added', $newUser->firstName .' '.$newUser->secondName.' Has SuccessfullyBeen Added. Use \'password\' as initial password to change it.');       
    }

    // ! editing users.
    public function editUser(Request $request){

        $editUser = User::where('id',$request->idOfUser)->get();
        foreach ($editUser as $editUser) {
            # code...
            $editUser->firstName = $request->firstName;
            $editUser->secondName = $request->secondName;
            $editUser->email = $request->email;
            $editUser->IdNo = $request->idNumber;
            $editUser->logIn_ip = '192.168.202.1';
            $editUser->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

            $editUser->save();

            $editUser->syncRoles([$request->roles]);
        }
        Alert::success($editUser->firstName .' '.$editUser->secondName.'Has SuccessfullyBeen Edited.', '');
        return back()->with('added', $editUser->firstName .' '.$editUser->secondName.' Has SuccessfullyBeen Edited.'); 
    }

    // ! deleting users. 

    public function deleteUsers(Request $request){

        

        $deleteUsers = User::where('id',$request->idOfUser)->get();

        $name = null;
        foreach ($deleteUsers as $deleteUser) {
            # code...
            $name = $deleteUser->firstName .' '.$deleteUser->secondName;
            $deleteUser->delete();
            $deleteUser->syncRoles([]);
        }

        Alert::success($name.'  Has SuccessfullyBeen Deleted.', '');
        return back()->with('added', $name.' Has SuccessfullyBeen Deleted.'); 

    }

    // ! this function is used to change the password if the user has a default password. 

    public function changeInitialPassword(Request $request){
        
        // ! checking to see if the password typed and the re-typed passwords are the same.

        $password = $request->password;
        $reTypedPassword = $request->retypePassword;

        if($password != $reTypedPassword){

            return back()->with('error','The Password And The Retyped Password Are Not The Same.');
            
        }
        else{

            // return "password do match.";
            // ! saving the password that is new. 

            $idOfUser = Auth::user()->id; 
            $users = User::where('id',$idOfUser)->get();

            foreach ($users as $user) {
                # code...
                $user->password = Hash::make($request->password);
                $user->passwordChanged = 1;
                $user->save();
            }


            return redirect('/');

        }        

    }

    public function getChangePassword(){
        return view('auth.changePassword');
    }

    public function postChangePassword(Request $request){

        $password = $request->password;
        $reTypedPassword = $request->retypePassword;
        $oldPassword = $request->oldpassword;

        if(Hash::make($request->oldpassword) != Auth::user()->password){
            return back()->with('error','The Old Password Is Not Similar To The Previous Password');
        }
        elseif($password != $reTypedPassword){

            return back()->with('error','The Password And The Retyped Password Are Not The Same.');
            
        }
        else{

            // return "password do match.";
            // ! saving the password that is new. 

            $idOfUser = Auth::user()->id; 
            $users = User::where('id',$idOfUser)->get();

            foreach ($users as $user) {
                # code...
                $user->password = Hash::make($request->password);
                $user->passwordChanged = 1;
                $user->save();
            }


            return redirect('/');

        }
    }

}
