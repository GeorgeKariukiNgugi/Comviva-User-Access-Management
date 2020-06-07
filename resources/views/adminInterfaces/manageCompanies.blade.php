@extends('adminInterfaces.adminExtension')
@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Manage Compaies.</h2>
@endsection
@section('mainContent')

<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Companies Registered.</h3>
    </div>
    <div class="box-body"> 
        @if (session('name'))
        <div role="alert" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('name') }}</div>
        @endif 
        
        @if (session('added'))
        <div role="alert" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('added') }}</div>
        @endif 
        <div class="row">
            <div class="col-md-12 ">
                <button type="button" href = "#" class="btn btn-success pull-right fa fa-plus" style="text-decoration: bold;" data-toggle="modal" data-target="#addCompany"> Add Company</button>                

                    {{-- This is the Modal To Add the Company To The System. --}}
                    <div class="modal fade" id="addCompany" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title text-center">ADD COMPANY.</h4>
                            </div>
                            <div class="modal-body">
                              <form action="/addCompany" method="POST">
                                {{ csrf_field() }}
                              <div class="row">
                                 <div class="col-md-4 col-md-offset-1">
                                   Name:
                                 </div>
                                 <div class="col-md-4 col-md-offset-1">
                                   <input required type="text" name="name" id="">
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                  Floor:
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <input required type="number" name="floor" id="">
                                </div>
                             </div>
                             <br>
                             <div class="row">
                              <div class="col-md-4 col-md-offset-1">
                                Wing:
                              </div>
                              <div class="col-md-4 col-md-offset-1">
                                <input required type="text" name="wing" id="">
                              </div>
                           </div>
                           <br>
                          
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn fa fa-plus btn-success"> Add Company</button>
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
              <th>Floor</th>
              <th>Wing</th>
              <th>Edit</th>
              <th>Delete</th>              
            </tr>
            </thead>
            <tbody>

                @php
                    $increment = 1;
                @endphp
                               
                @foreach ($companies as $company)

                <tr>
                    <td>
                       {{$increment++}} 
                    </td>
                    <td>
                        {{$company->name}}
                    </td>
                    <td>
                        {{$company->floor}}
                    </td>
                    <td>
                        {{$company->wing}}
                    </td>
                    <td>
                        <button class="btn btn-success fa fa-edit" href="#" data-toggle="modal" data-target="{{"#editCompany".$company->id}}"> Edit. </button>

                        {{-- The modal to edit the companies. --}}

                        <div class="modal fade" id="{{"editCompany".$company->id}}" style="display: none;">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title text-center">EDIT {{$company->name}}.</h4>
                              </div>
                              <div class="modal-body">
                                <form action="/editCompany" method="POST">
                                  {{ csrf_field() }}
                                <div class="row">
                                  <input type="hidden" name="idOfCompany" value="{{$company->id}}">
                                   <div class="col-md-4 col-md-offset-1">
                                     Name:
                                   </div>
                                   <div class="col-md-4 col-md-offset-1">
                                     <input required type="text" name="name" value="{{$company->name}}" id="">
                                   </div>
                                </div>
                                <br>
                                <div class="row">
                                  <div class="col-md-4 col-md-offset-1">
                                    Floor:
                                  </div>
                                  <div class="col-md-4 col-md-offset-1">
                                    <input required type="number" name="floor" value="{{$company->floor}}" id="">
                                  </div>
                               </div>
                               <br>
                               <div class="row">
                                <div class="col-md-4 col-md-offset-1">
                                  Wing:
                                </div>
                                <div class="col-md-4 col-md-offset-1">
                                  <input required type="text" name="wing" value="{{$company->wing}}" id="">
                                </div>
                             </div>
                             <br>
                            
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn fa fa-plus btn-success"> Save Changes</button>
                              </div>
                            </form>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>  
                        

                    </td>
                    <td>
                        <button class="btn btn-danger fa fa-trash" href="#" data-toggle="modal" data-target="{{"#deleteCompany".$company->id}}"> Delete. </button>
                        <div class="modal fade" id="{{"deleteCompany".$company->id}}">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                  <h4 class="modal-title text-center">Delete Company : {{$company->name}}</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-md-12 text-center">
                                        <h4>Are You Sure You Want To Delete Company: {{$company->name}}</h4>
                                        <h5 style="color:red;">All the Records related to {{$company->name}} will be delete and not recovarable.</h5>
                                      </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-info pull-left fa fa-times" data-dismiss="modal"> Close</button>
                                  <form action="/deleteCompany" method="POST">
                                      {{ csrf_field() }}
                                    <input type="hidden" name="idOfCompay" value="{{$company->id}}">
                                    <button type="submit" class="btn btn-danger fa fa-trash-o "> Delete</button>
                                  </form>
                                  
                                  
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                    </td>
                </tr>
                    
                @endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <th>S <sub>no</sub></th>
                    <th>Name</th>              
                    <th>Floor</th>
                    <th>Wing</th>
                    <th>Edit</th>
                    <th>Delete</th>              
                  </tr>
                </tfoot>
        </table>

    </div>
</div>

@endsection