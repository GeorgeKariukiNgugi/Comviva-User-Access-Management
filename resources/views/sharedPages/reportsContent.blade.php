@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Reports Generation.</h2>
@endsection

@section('mainContent')
<form action="/postingReport" method="POST">
  {{ csrf_field() }}
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="row">
      <div class="col-md-4 col-md-offset-1">
            <div class="form-group ">
              <label> Start Date:</label>
  
              <div class="input-group input-group-sm date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input required type="text" name="startDate" class="form-control pull-right datepicker" id="datepicker">
              </div>
              <!-- /.input group -->
            </div>
      </div>      
      <div class="col-md-4 col-md-offset-1">
          <div class="form-group ">
            <label> End Date:</label>
  
            <div class="input-group input-group-sm date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input required type="text" name="endDate" class="form-control pull-right datepicker" id="datepicker">
            </div>
            <!-- /.input group -->
          </div>
        </div>       
      </div>  
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="form-group ">
            <label class="text-center"> Company:</label>
              <select required name="company" class="form-control  pull-right select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="2" tabindex="-1" aria-hidden="true">
                <option data-select2-id="104" value="0" selected>All</option>
                  @foreach ($company as $company)
                  <option data-select2-id="{{$company->id+30}}" value="{{$company->id}}">{{$company->name}}</option>
                  @endforeach
              </select> 
          </div>
      </div>
       </div>
       <br>
       <div class="row">
        <div style="text-align: center" class="col-md-4 col-md-offset-4 text-center">            
                <button type="submit" class=" fa fa-download btn btn-block btn-success btn-lg">  Generate And Download Report. </button>              
          </div>   
        </div>
  </div>
</div>
</form>
@endsection