<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
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

        $newUser->save();

        $newUser->syncRoles([$request->roles]);
        Alert::success($newUser->firstName .' '.$newUser->secondName.'Has SuccessfullyBeen Added.', '');
        return back()->with('added', $newUser->firstName .' '.$newUser->secondName.' Has SuccessfullyBeen Added.');       
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
}
