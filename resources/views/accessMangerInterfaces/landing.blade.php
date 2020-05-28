@extends('accessMangerInterfaces.accessManagerExtension')

@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" > Registering And Checking In Visitors.</h2>
@endsection

@section('mainContent')
<section class="content">
  
  
  <form action="/registerVisitor" method="POST" enctype="multipart/form-data">
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
                  @foreach ($errors->all() as $error)
            
                  <div role="alert" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span id="text">{{$error}}</div>
                  @endforeach
                </div>
              </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fisrt Name</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input required name="firstName" type="text" class="form-control" placeholder="First Name">
                          </div>
                          </div>
                    </div>
                    <div class="col-md-6">
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
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>ID Number</label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input required type="number" name="idNumber" class="form-control" placeholder="Id Number">
                      </div>
                      </div>
                </div>   
                </div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                        <label>Address:</label>
                        <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                        <input required type="text" name="address" class="form-control" placeholder="Addres">
                      </div>
                      </div>
                </div>   
                </div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group" data-select2-id="13">
                      <label>Type Of Visitor: </label>
                      <select required name="typeOfVisitor" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option selected="selected" data-select2-id="40" value = "1">Enquiry</option>
                        <option data-select2-id="22" value="2">Service Provision</option>
                        <option data-select2-id="23" value = "3">Meeting</option>                                             
                      </select>                        
                    </div>
                    </div>                                        
                </div>
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group" data-select2-id="13">
                      <label>Company Visitor: </label>
                      <select required name="company" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">                               
                          @foreach ($company as $company)
                          <option data-select2-id="{{$company->id+30}}" value="{{$company->id}}">{{$company->name}}</option>
                          @endforeach
                      </select>                        
                    </div>
                    </div> 
                </div>               
                <div class="row">
                  <div class="col-md-6 col-md-offset-3">
                    <div class="form-group">
                      <label for="exampleInputFile">Image Of Visitor.</label>
                      {{-- <input type="file" required name="visitorImage"  id="exampleInputFile"> --}}
                      <input id="exampleInputFile"  name="visitorImage" type="file">
    
                      <p class="help-block">Click To Select File.</p>
                    </div>
                  </div>
                </div>
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
                    
                        <p> Regular Visitor.</p>
                        </div>
                        <div class="icon">
                        <i class="fa fa-user-plus"></i>
                        </div>
                        <a href = "" style="color: white;" class="small-box-footer">Regular Visitor <i class="fa fa-arrow-circle-o-right"></i></a>
                    </div>
                    </div>
            </div>                     
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>  
      
@endsection
{{-- <h4>This is the landing page of the application for the User Access Managers.</h4> --}}