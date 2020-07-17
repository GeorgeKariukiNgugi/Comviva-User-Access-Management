@extends('adminInterfaces.adminExtension')
@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Manage Users.</h2>
@endsection
@section('mainContent')
<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Users Registered.</h3>
    </div>
    <div class="box-body"> 
        @if (session('name'))
        <div role="alert" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('name') }}</div>
        @endif 
        
        @if (session('added'))
        <div role="alert" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('added') }}</div>
        @endif 
        <div class="row">
            <div  class="col-md-12 ">
              <div>
                <button type="button" href = "#" class="btn btn-success pull-right fa fa-plus" style="text-decoration: bold;" data-toggle="modal" data-target="#adduser"> Add User</button>                
              </div>

                

                    {{-- This is the Modal To Add the user To The System. --}}
                    <div class="modal fade" id="adduser" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title text-center">ADD USER.</h4>
                            </div>
                            <div class="modal-body">
                              <form action="/addNewUser" method="POST">
                                {{ csrf_field() }}
                              <div class="row">
                                 <div class="col-md-4 col-md-offset-1">
                                   First Name:
                                 </div>
                                 <div class="col-md-4 col-md-offset-1">
                                   <input required type="text" name="firstName" id="">
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                  Second Name:
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <input required type="text" name="secondName" id="">
                                </div>
                             </div>
                              <br>
                              <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                  ID Number:
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <input required type="number" name="idNumber" id="">
                                </div>
                             </div>
                             <br>
                             <div class="row">
                              <div class="col-md-4 col-md-offset-1">
                                Email:
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <input required type="email" name="email" id="">
                              </div>
                           </div>
                           <br>
                           <div class="row">
                            <div class="col-md-4 col-md-offset-1">
                              Role:
                            </div>
                            <div class="col-md-4 col-md-offset-1">
                              {{-- <input required type="text" name="wing" id=""> --}}
                              <select name="roles" id="">
                                
                                @foreach ($roles as $role)
                                @if ($role->name != 'approvingmanager')
                                <option value="{{$role->name}}">{{$role->name}}</option>  
                                @endif                                                              
                                @endforeach
                                
                              </select>
                            </div>
                         </div>
                           <br>
                          
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn fa fa-plus btn-success"> Add user</button>
                            </div>
                          </form>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>                  
            </div>
        </div>
        <br>
        <table style="font-family: 'Times New Roman', Times, serif" id="example1" class="table table-hover  table-bordered table-striped">
            <thead>
            <tr>
              <th>S <sub>no</sub></th>
              <th>Name</th>              
              <th>ID</th>
              <th>Email</th>
              <th>Roles</th>
              <th>Edit</th>
              <th>Delete</th>              
            </tr>
            </thead>
            <tbody>

                @php
                    $increment = 1;
                @endphp
                               
                @foreach ($users as $user)
                @php
                $rolesUser = $user->getRoleNames();
                @endphp
                @if ($rolesUser[0] != 'approvingmanager')                                    
                <tr>
                    <td>
                       {{$increment++}} 
                    </td>
                    <td>
                        {{$user->firstName. ' '.$user->secondName }}
                    </td>
                    <td>
                        {{$user->IdNo}}
                    </td>
                    <td>
                      {{$user->email}}
                    </td>
                    <td>
                        {{-- {{$user->wing}} --}}
                       
                        @foreach ($rolesUser as $role)
                            @if ($role == 'admin')
                            <p style="font-size: 14px;" class="label  bg-red">{{$role}}</p>  
                            @elseif($role == 'accessmanager')
                            <p style="font-size: 14px;" class="label  bg-green">{{$role}}</p>  
                            @endif                        

                        @endforeach
                    </td>
                    <td>
                        <button class="btn btn-success fa fa-edit" href="#" data-toggle="modal" data-target="{{"#edituser".$user->IdNo}}"> Edit. </button>

                        {{-- The modal to edit the companies. --}}

                        <div class="modal fade" id="{{'edituser'.$user->IdNo}}" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title text-center">EDIT USER.</h4>
                              </div>
                              <div class="modal-body">
                                <form action="/editUser" method="POST">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="idOfUser" value="{{$user->id}}">
                                <div class="row">
                                   <div class="col-md-4 col-md-offset-1">
                                     First Name:
                                   </div>
                                   <div class="col-md-4 col-md-offset-1">
                                     <input value="{{$user->firstName}}" required type="text" name="firstName" id="">
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-4 col-md-offset-1">
                                    Second Name:
                                  </div>
                                  <div class="col-md-4 col-md-offset-1">
                                    <input value="{{$user->secondName}}" required type="text" name="secondName" id="">
                                  </div>
                               </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-4 col-md-offset-1">
                                    ID Number:
                                  </div>
                                  <div class="col-md-4 col-md-offset-1">
                                    <input value="{{$user->IdNo}}" required type="number" name="idNumber" id="">
                                  </div>
                               </div>
                               <br>
                               <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                  Email:
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <input required type="email" value="{{$user->email}}" name="email" id="">
                                </div>
                             </div>
                             <br>
                             <div class="row">
                              <div class="col-md-4 col-md-offset-1">
                                Role:
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                {{-- <input required type="text" name="wing" id=""> --}}
                                <select name="roles" id="">
                                  
                                  @foreach ($roles as $role)
                                  {{-- <option value="{{$role->id}}">{{$role->name}}</option> --}}
                                  {{-- <option value="">{{$role}}</option> --}}
                                  @if ($role->name != 'approvingmanager')
                                  <option value="{{$role->name}}">{{$role->name}}</option>  
                                  @endif  
                                  @endforeach
                                  
                                </select>
                              </div>
                           </div>
                             <br>
                            
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn fa fa-gavel btn-success"> Save Changes.</button>
                              </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div> 
                        

                    </td>
                    <td>

                      @if ($user->id == Auth::user()->id)
                      <button disabled class="btn btn-danger fa fa-trash" href="#" data-toggle="modal" data-target="{{"#deleteuser".$user->id}}"> Delete. </button>
                      @else
                      <button class="btn btn-danger fa fa-trash" href="#" data-toggle="modal" data-target="{{"#deleteuser".$user->id}}"> Delete. </button>
                      @endif
                        
                        <div class="modal fade" id="{{"deleteuser".$user->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                  <h4 class="modal-title text-center">Delete User : {{$user->firstName .' '.$user->secondName}}</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-md-12 text-center">
                                        <h4>Are You Sure You Want To Delete user: {{$user->firstName .' '.$user->secondName}}</h4>
                                        <h5 style="color:red;">All the Records related to {{$user->firstName .' '.$user->secondName}} will be delete and not recovarable.</h5>
                                      </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-info pull-left fa fa-times" data-dismiss="modal"> Close</button>
                                  <form action="/deleteuser" method="POST">
                                      {{ csrf_field() }}
                                    
                                      <input type="hidden" name="idOfUser" value="{{$user->id}}">

                                      @if ($user->id == Auth::user()->id)
                                      <button type="submit" disabled class="btn btn-danger  fa fa-trash-o "> Delete</button>
                                      @else
                                      <button type="submit" class="btn btn-danger fa fa-trash-o "> Delete</button>
                                      @endif                                    
                                  </form>
                                  
                                  
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                    </td>
                </tr>
                @endif 
                @endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <th>S <sub>no</sub></th>
                    <th>Name</th>              
                    <th>ID</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Edit</th>
                    <th>Delete</th>              
                  </tr>
                </tfoot>
        </table>

    </div>
</div>

@endsection