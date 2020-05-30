@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Search For Visitor.</h2>
@endsection

@section('mainContent')
<form action="/postVisitorSearch" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="input-group input-group-lg">
                <div class="input-group-btn">
                  <button type="button"  class="btn  btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span id="selectedButton">National Id</span> 
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#"  class="searchCreteriaValue"    id="1">National Id</a></li>
                    <li><a href="#" class="searchCreteriaValue" id="2">Name</a></li>
                    <li><a href="#" class="searchCreteriaValue" id="3">Address</a></li>        
                  </ul>
                </div>
                <input type="hidden" id="typeId" name="searchCreteria" value = "1">
                <!-- /btn-group -->
                <input type="text" name="searchText" required class="form-control">                
              </div>

             
        </div>
        </div>
        <br>
        <div class="row">
        <div style="text-align: center" class="col-md-2 col-md-offset-5">            
                <button type="submit" class=" fa fa-search btn btn-block btn-success btn-lg">  Search Visitor.</button>              
          </div>   
        </div>
      </form>

        {{-- <div class="row">         --}}
          @if (session('searchResult'))
          @php
              
              $company = session('company');

          @endphp
          <br>
          <div class="row">
          <div class="col-md-10 col-md-offset-1">
            
          <div class="box box-success">
            <div class="box-header">              
              <h3 class="box-title">Search Results.</h3>
            </div>
            <div class="box-body">
          @if (count((session('searchResult'))) > 0)

            
            <!-- /.box-header -->
            <h4 class="text-center">Results for search  <span style="color:blue; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"> {{session('names')}} </span></h4>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>S <sub>no</sub></th>
              <th>First Name</th>
              <th>Second Name</th>
              <th>Id</th>
              <th>All Details</th>
              <th>Check In Visitor</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $searchResult = session('searchResult');
                  
                  $startNo = 1;
              @endphp
                @foreach ($searchResult as $item)
                    <tr>
                      <td>{{$startNo++}}</td>
                      <td>{{$item->firstName}}</td>
                      <td>{{$item->secondName}}</td>
                      <td>{{$item->idNo}}</td>
                      <td class="text-center">
                        <button type="button" data-toggle="modal" data-target="#details{{$item->id}}" class="  btn  fa fa-bars btn-info"> See Details</button>
                      </td>
                      <td class="text-center">                        
                          <button type="button" data-toggle="modal" data-target="#checkInVisitor{{$item->id}}"  class="fa fa-check-square btn  btn-success">  Check In Visitor.</button>                                                
                      </td>
                    </tr>                    
                    {{-- modal section. --}}
                    {{-- This modal is used to get the details of the visitor.  --}}
                    <div class="modal fade" id="details{{$item->id}}" style="display: none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close fa fa-times-circle" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title text-center">{{$item->firstName. '  '. $item->secondName}}  Details.</h4>
                          </div>
                          <div class="modal-body">
                            {{-- <p>One fine body…</p> --}}
                            {{-- <h4 class=""> </h4> --}}
                            <div class="row">
                              <div class="col-md-3">
                                <h5>First Name: </h5>
                              </div>
                              <div class="col-md-9">
                                {{$item->firstName}}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <h5>Second Name: </h5>
                              </div>
                              <div class="col-md-9">
                                {{$item->secondName}}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <h5>National ID number: </h5>
                              </div>
                              <div class="col-md-9">
                                {{$item->idNo}}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <h5>Address: </h5>
                              </div>
                              <div class="col-md-9">
                                {{$item->address}}
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-3">
                                <h5>Photo: </h5>
                              </div>
                              <div class="col-md-9">
                                {{-- {{$item->address}} --}}
                                <img src="{{asset($item->photoUrl)}}" alt="">
                                
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-left fa  fa-times-circle" data-dismiss="modal"> Close</button>                            
                            <button type="button" class="fa fa-check-square btn checkInButtonClicked  btn-success" data-toggle="modal" data-id="{{$item->id}}" data-target="#checkInVisitor{{$item->id}}"  class="fa fa-check-square btn  btn-success">  Check In Visitor.</button>                           
                            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>

                    {{-- This modal is used to Check In the visitor. --}}
                    <div class="modal fade" id="checkInVisitor{{$item->id}}" style="display: none;">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close fa fa-times-circle" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Checking In User: {{$item->firstName. '  '. $item->secondName}}</h4>                                                       
                          </div>
                          <div class="modal-body">

                            {{-- The form to submit the application. --}}

                            <form action="/checkInVisitor" method="POST">
                              {{ csrf_field() }}
                                  <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                      <div class="form-group" data-select2-id="{{"13".$item->id."company"}}">
                                        <label>Company Visitor: </label>
                                        <select required name="company" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="{{"2".$item->id."company"}}" tabindex="-1" aria-hidden="true">                               
                                            @foreach ($company as $companys)
                                            <option data-select2-id="{{($companys->id+100).$item->id}}" value="{{$companys->id}}">{{$companys->name}}</option>
                                            @endforeach
                                        </select>                        
                                      </div>
                                      </div> 
                                  </div> 
                                  <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                      <div class="form-group" data-select2-id="{{"13".$item->id."visitor"}}">
                                        <label>Type Of Visitor: </label>
                                        <select required name="typeOfVisitor" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="{{"1".$item->id."company"}}" tabindex="-1" aria-hidden="true">
                                          <option selected="selected" data-select2-id="{{"40".$item->id}}" value = "1">Enquiry</option>
                                          <option data-select2-id="{{"22".$item->id}}" value="2">Service Provision</option>
                                          <option data-select2-id="{{"23".$item->id}}" value = "3">Meeting</option>                                             
                                        </select>                        
                                      </div>
                                      </div>                                        
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger pull-left fa  fa-times-circle" data-dismiss="modal"> Close</button>
                                    <input type="hidden" name="idOfVisitor" value="{{$item->id}}">
                                    <button type="submit" class="fa fa-check-square btn  btn-success">  Check In Visitor.</button>  
                            </form>

                                                      
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
              <th>S <sub>no</sub></th>
              <th>First Name</th>
              <th>Second Name</th>
              <th>Id</th>
              <th>All Details</th>
              <th>Check In Visitor</th>
            </tr>
            </tfoot>
          </table>
          @else
          <h4 class="text-center">No results Found with the  <span style="color:blue; font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"> {{session('names')}} </span></h4>        
          @endif
        </div>
        <!-- /.box-body -->
        </div>
      </div>
    </div>
          @endif

@endsection