<section class="content">    
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-9">
        <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title text-center" style="text-align: center"> Visitor Details</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 col-md-offset-3">

                  @if (session('checkedOut'))
                  <div role="alert" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('checkedOut') }}</div>
                  @endif

                  @if (session('status'))
                        <div role="alert" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="text">{{ session('status') }}</div>
                  @endif

                  @if (session('details'))
                  @php
                      $details = session('details');
                  @endphp
                  <div role="alert" class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="text">
                    {{-- {{ session('status') }} --}}
                    The Visitor <span style="color:black">{{$details->accessLogBelongsToVisitor->firstName. '   '. $details->accessLogBelongsToVisitor->secondName}}</span>  Has Already Been Logged In, 
                    <a style="color:blue;" href="#" data-target = "#alreadyLoggedVisitor" data-toggle="modal"> Click to see  More Details.</a>
                  </div>


                  {{-- Modal To Show more Details. --}}

                  <div class="modal fade" id="alreadyLoggedVisitor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Details For: {{$details->accessLogBelongsToVisitor->firstName. '   '. $details->accessLogBelongsToVisitor->secondName}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-md-4">
                                Name:
                            </div>
                            <div class="col-md-8">
                              {{$details->accessLogBelongsToVisitor->firstName. '   '. $details->accessLogBelongsToVisitor->secondName}}
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              National ID Number: 
                            </div>
                            <div class="col-md-8">
                              {{$details->accessLogBelongsToVisitor->idNo}}
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              Time In: 
                            </div>
                            <div class="col-md-8">
                              @php
                                   $dateToFormat = date_create($details->timeIn);
                                   $date = date_format($dateToFormat, "D-d-F-Y H:i:s");  

                              @endphp
                              {{$date}}
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              Company Name Visited: 
                            </div>
                            <div class="col-md-8">
                              {{$details->accessLogBelongsToCompany->name}}
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-4">
                              Form Of Visit:  
                            </div>
                            <div class="col-md-8">
                              {{$details->accessLogBelongsToAtypeOfVisitor->type}}
                            </div>
                          </div>


                          <div class="row">
                            <div class="col-md-4">
                              CheckedIn By:
                            </div>
                            <div class="col-md-8">
                              {{$details->accessLogHasOneApprover->firstName. '  '.$details->accessLogHasOneApprover->secondName }}
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-md-4">
                              Photo: 
                            </div>
                            <div class="col-md-8">
                              <img src="{{$details->accessLogBelongsToVisitor->photoUrl}}" alt="">
                            </div>
                          </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-info fa fa-times pull-left" data-dismiss="modal"> Close</button>
                          <form action="/checkingOutVisitor" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="idOfCheckedOutVisitor" value="{{$details->id}}">
                            <button type="submit" class=" fa fa-sign-out btn btn-danger"> Check Out.</button>
                          </form>                          
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif

                  @foreach ($errors->all() as $error)
            
                  <div role="alert" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="text">{{$error}}</div>
                  @endforeach
                </div>
              </div>
              <form action="/registerVisitor" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="form-group">
                            <label>Fisrt Name</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input required name="firstName" type="text" class="form-control" placeholder="First Name">
                          </div>
                          </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="form-group">
                            <label>Second Name</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input required name="secondName" type="text" class="form-control" placeholder="Second Name">
                          </div>
                          </div>
                    </div>                        
                </div>
                <div class="row">
                  <div class="col-md-4 col-md-offset-1 ">
                    <div class="form-group">
                        <label>ID Number</label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input required type="number" name="idNumber" class="form-control" placeholder="Id Number">
                      </div>
                      </div>
                </div>
                <div class="col-md-4 col-md-offset-1 ">
                  <div class="form-group">
                      <label>Phone Number</label> <span>(Max Length 10 digits.)</span>
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input required type="text" pattern="\d*" name="phoneNumber" maxlength="10" minlength="10" class="form-control" placeholder="Phones Number">
                    </div>
                    </div>
              </div>   
                </div>
                <div class="row">
                  <div class="col-md-4 col-md-offset-1">
                    <div class="form-group">
                        <label>Address:</label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                        <input required type="text" name="address" class="form-control" placeholder="Addres">
                      </div>
                      </div>
                </div> 
                <div class="col-md-4 col-md-offset-1">
                  <div class="form-group">
                    <label for="exampleInputFile">Image Of Visitor.</label>
                    {{-- <input type="file" required name="visitorImage"  id="exampleInputFile"> --}}
                    <input id="exampleInputFile"  name="visitorImage" type="file">
  
                    <p class="help-block">Click To Select File.</p>
                  </div>
                </div>  
                </div>
                {{-- <hr style="color: gray"> --}}

                <hr>

                <div class="row">
                  <div class="col-md-10  col-md-offset-1">
                    <div class="row">
                      <div class="col-md-4 ">
                        <div class="form-group" data-select2-id="13">
                          <label>Reason For Visit: </label>
                          <select required name="typeOfVisitor" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">                       
                            @foreach ($typeOfVisitors as $typeOfVisitor)
                            <option data-select2-id="{{$typeOfVisitor->id+5685}}" value="{{$typeOfVisitor->id}}">{{$typeOfVisitor->type}}</option>
                            @endforeach
                          </select>                        
                        </div>
                        </div>  
                        <div class="col-md-4">
                          <div class="form-group" data-select2-id="13">
                            <label>Company To Visit: </label>
                            <select required name="company" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">                               
                                @foreach ($company as $company)
                                <option data-select2-id="{{$company->id+30}}" value="{{$company->id}}">{{$company->name}}</option>
                                @endforeach
                            </select>                        
                          </div>
                          </div> 
                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="exampleInputFile">Approving Manager: </label>
                              {{-- <input type="file" required name="visitorImage"  id="exampleInputFile"> --}}
                              <select required name="pointsperson" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="5" tabindex="-1" aria-hidden="true">                               
                                  @foreach ($companyPointsPersons as $persons)
                                  <option data-select2-id="{{$persons->id+452541}}" value="{{$persons->id}}">{{$persons->employeeName}} ::: {{$persons->companyEmployeeBelongsToCompany->name}} </option>
                                  @endforeach
                                  
                              </select> 
                            </div>
                          </div> 
                    </div>
                  </div>
                  
                                     
                </div>
                {{-- <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group" data-select2-id="13">
                      <label>Company To Visit: </label>
                      <select required name="company" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">                               
                          @foreach ($company as $company)
                          <option data-select2-id="{{$company->id+30}}" value="{{$company->id}}">{{$company->name}}</option>
                          @endforeach
                      </select>                        
                    </div>
                    </div> 
                </div>                --}}
                {{-- <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                      <div class="form-group">
                        <label for="exampleInputFile">Approving Manager: </label>
                        {{-- <input type="file" required name="visitorImage"  id="exampleInputFile"> --}}
                        {{-- <select required name="pointsperson" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="5" tabindex="-1" aria-hidden="true">                               
                            @foreach ($companyPointsPersons as $persons)
                            <option data-select2-id="{{$persons->id+452541}}" value="{{$persons->id}}">{{$persons->employeeName}} ::: {{$persons->companyEmployeeBelongsToCompany->name}} </option>
                            @endforeach
                            
                        </select> 
                      </div>
                    </div>
                  </div>  --}}
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-lg fa fa-circle-o-notch btn-info">  Reset.</button>
              <button type="submit" class="btn btn-lg btn-success pull-right fa fa-check-square">  Register And Check In.</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.col -->
      <div class="col-md-3">
        <div>
            <div>
                <div class=" col-md-12 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                        <h2><i class="fa fa-user-plus"></i></h2>
                    
                        <p> Returning Visitor.</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user-plus"></i>
                        </div>
                        <a href = "/regularVisitor" style="color: white;" class="small-box-footer">Returning Visitor <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                    </div>
            </div>                     
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>  