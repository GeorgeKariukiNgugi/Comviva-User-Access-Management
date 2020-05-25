@extends('accessMangerInterfaces.accessManagerExtension')
@section('mainContent')
<section class="content">
    <div class="row">
      <div class="col-md-9">
        <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title" style="text-align: center"> Visitor Details</h3>
            </div>
            <div class="box-body">
             
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Fisrt Name</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="First Name">
                          </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Second Name</label>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Second Name">
                          </div>
                          </div>
                    </div>
                </div>
                <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                  <option value="AL">Alabama</option>                    
                  <option value="WY">Wyoming</option>
                </select>
            </div>
            <!-- /.box-body -->
          </div>
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
    </script>
@endsection
{{-- <h4>This is the landing page of the application for the User Access Managers.</h4> --}}