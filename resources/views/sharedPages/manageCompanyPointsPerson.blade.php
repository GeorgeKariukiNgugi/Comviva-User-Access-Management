@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >
        Managing The Approving Managers. 
    </h2>
@endsection
@section('mainContent')

<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Approving Managers Registered.</h3>
    </div>
    <div class="box-body"> 
      <div style="margin-bottom: 1.3%;">
        <div>
          <button type="button" href = "#" class="btn btn-success pull-right fa fa-plus" style="text-decoration: bold;" data-toggle="modal" data-target="#adduser"> Add Approving Manager.</button>

          {{-- Modal To add a new company points person. --}}

          <div class="modal fade" id="adduser" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title text-center">ADD NEW APPROVING MANAGER</h4>
                </div>
                <div class="modal-body">
                  <form action="/addCompanyPointsPerson" method="POST">
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
               <br>
               <div class="row">
                <div class="col-md-4 col-md-offset-1">
                  Email Address:
                </div>
                <div class="col-md-4 col-md-offset-1">
                  <input required type="email" name="email" id="">
                </div>
             </div>
             <br>
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
           <br>
               <div class="row">
                <div class="col-md-4 col-md-offset-1">
                  Company:
                </div>
                <div class="col-md-4 col-md-offset-1">
                  {{-- <input required type="text" name="wing" id=""> --}}
                  <select name="company" id="">
                    
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}"> {{$company->name}}</option>
                    @endforeach
                   
                    
                  </select>
                </div>
             </div>
               <br>
              
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn fa fa-plus btn-success"> Add.</button>
                </div>
              </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

        </div>
        <br>
      </div>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>S <sub>no</sub></th>
              <th>Names</th>  
              <th>Company</th>                          
              <th>Delete</th>
              <th>Edit</th>
            </tr>
            </thead>
            <tbody>
              @if (count($allEmployees) >0 )  
                {{-- This is the location of the companies points persons. --}}
                @php
                    $counter = 1;
                @endphp
                @foreach ($allEmployees as $employee)
                <tr>
                <td>
                  {{$counter++}} 
                </td>
                    
                <td>
                  {{$employee->employeeName}} 
                </td>

                <td>
                  {{$employee->companyEmployeeBelongsToCompany->name}} 
                </td>

                <td>
                  <button class="btn btn-success fa fa-edit" href="#" data-toggle="modal" data-target="{{"#updateCompanyEmployee".$employee->id}}"> Edit. </button>

                  <div class="modal fade" id="{{"updateCompanyEmployee".$employee->id}}" style="display: none;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title text-center">UPDATE APPROVING MANAGER</h4>
                        </div>
                        <div class="modal-body">
                          <form action="/updateCompanyEmployee" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="idOfUser" value="{{$employee->id}}">
                          <div class="row">
                             <div class="col-md-4 col-md-offset-1">
                               Name:
                             </div>
                             <div class="col-md-4 col-md-offset-1">
                               <input required type="text" name="name" id="" value="{{$employee->employeeName}}">
                             </div>
                          </div>
                          <br>                                                          
                       <br>
                       <div class="row">
                        <div class="col-md-4 col-md-offset-1">
                          Company:
                        </div>
                        <div class="col-md-4 col-md-offset-1">
                          {{-- <input required type="text" name="wing" id=""> --}}
                          <select name="company" id="">
                            
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}"> {{$company->name}}</option>
                            @endforeach
                           
                            
                          </select>
                        </div>
                     </div>
                       <br>
                      
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger fa fa-times pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn fa fa-plus btn-success"> UPDATE.</button>
                        </div>
                      </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                </td>

                <td>
                  <button class="btn btn-danger fa fa-trash" href="#" data-toggle="modal" data-target="{{"#deleteuser".$employee->id}}"> Delete. </button>

                  <div class="modal fade" id="{{"deleteuser".$employee->id}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title text-center">Delete User : {{$employee->employeeName}}</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                              <div class="col-md-12 text-center">
                                <h4>Are You Sure You Want To Delete user:  {{$employee->employeeName}}</h4>
                                <h5 style="color:red;">All the Records related to  {{$employee->employeeName}} will be delete and not recovarable.</h5>
                              </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-info pull-left fa fa-times" data-dismiss="modal"> Close</button>
                          <form action="/deleteCompanyPointsPerson" method="POST">
                              {{ csrf_field() }}                            
                              <input type="hidden" name="idOfUser" value=" {{$employee->id}}">                              
                              <button type="submit" class="btn btn-danger  fa fa-trash-o "> Delete</button>                                                               
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
                @else
                {{-- <h4 class="text-center">No Company Points Persons Were Found. Click "Add Button." To Add.  </h4>         --}}
                @endif
            </tbody>
            <tfoot>
                <tr>
                  <th>S <sub>no</sub></th>
                  <th>Names</th>                            
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                </tfoot>
        </table>
       
    </div>
</div>


@endsection