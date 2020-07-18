@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Checking Out Visitors.</h2>
@endsection
@section('mainContent')

<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Visitors Checked In.</h3>
    </div>
    <div class="box-body">
      @if (session('checkedOut'))
      <div role="alert" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><span class="text-center" id="text">{{ session('checkedOut') }}</div>
      @endif
        <table style="font-family: 'Times New Roman', Times, serif" id="example1" class="table table-hover  table-bordered table-striped">
            <thead>
            <tr>
              <th>S <sub>no</sub></th>
              <th>Name</th>              
              <th>Id</th>
              <th>Time In</th>
              <th>Company Visited</th>
              <th>Type Of Visit</th>
              <th>Approving Manager</th>
              <th>Approval</th>
              <th>Image</th>
              <th>Check Out Visitor</th>
            </tr>
            </thead>
            <tbody>

                @php
                    $increment = 1;
                @endphp
                @foreach ($visitors as $visitor)
                <tr>
                <td>
                    {{$increment++}}
                </td>
                    <td>
                        {{ $visitor->accessLogBelongsToVisitor->firstName. '   '.  $visitor->accessLogBelongsToVisitor->secondName}}
                    </td>
                    <td>
                        {{ $visitor->accessLogBelongsToVisitor->idNo}}
                    </td>
                    <td>
                        @php
                        $dateToFormat = date_create( $visitor->timeIn);
                        $date = date_format($dateToFormat, "D-d-F-Y H:i:s");
                   @endphp
                   {{$date}}
                    </td>
                    <td>
                        {{ $visitor->accessLogBelongsToCompany->name}}
                    </td>
                    <td>
                        {{ $visitor->accessLogBelongsToAtypeOfVisitor->type}}
                    </td>
                    <td>
                      {{$visitor->visitorBelongsToCompanyAttache->employeeName}}
                    </td>
                    @if ($visitor->approvingManagerApproval == 0)
                        <td class="text-center">
                          <p style="color: blue;text-decration:bold;font-size:16px;"> <i class="fa fa-circle-o-notch"></i> WAITING. </p>
                        </td>
                        <td class="text-center">

                            <button class=" btn btn-info fa fa-file-image-o" href="#" data-toggle="modal" data-target="{{"#imageModal".$visitor->accessLogBelongsToVisitor->id}}"> Image </button>
                        </td>
                        <td class="text-center">
                          <button disabled class="btn btn-danger fa fa-sign-out checkOutVisitorButton"                                                                                               
                                                                        data-toggle="modal"
                                                                        data-target="{{"#checkingOutVisitor".$visitor->id}}"> Check Out Visitor</button>
                      </td>
                      @elseif($visitor->approvingManagerApproval == 1)
                        <td class="text-center">
                          <p style="color: green;text-decration:bold;font-size:16px;"> <i class="fa fa-check"></i> APPROVED. </p>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info fa fa-file-image-o" href="#" data-toggle="modal" data-target="{{"#imageModal".$visitor->accessLogBelongsToVisitor->id}}"> Image </button>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-danger fa fa-sign-out checkOutVisitorButton"                                                                                               
                                                                        data-toggle="modal"
                                                                        data-target="{{"#checkingOutVisitor".$visitor->id}}"> Check Out Visitor</button>
                      </td>
                      @elseif($visitor->approvingManagerApproval == -1)
                      <td class="text-center">
                        <p style="color: red;text-decration:bold;font-size:16px;"> <i class="fa fa-times"></i> DENIED. </p>
                      </td>
                      <td class="text-center">
                          <button class="btn btn-info fa fa-file-image-o" href="#" data-toggle="modal" data-target="{{"#imageModal".$visitor->accessLogBelongsToVisitor->id}}"> Image </button>
                      </td>
                      <td class="text-center">
                        <button class="btn btn-danger fa fa-sign-out checkOutVisitorButton"                                                                                               
                                                                      data-toggle="modal"
                                                                      data-target="{{"#checkingOutVisitor".$visitor->id}}"> Check Out Visitor</button>
                    </td>
                      @endif
                   
                        <div class="modal fade" id="{{"imageModal".$visitor->accessLogBelongsToVisitor->id}}" style="display: none;">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                  <h4 class="modal-title">Image Of {{ $visitor->accessLogBelongsToVisitor->firstName. '   '.  $visitor->accessLogBelongsToVisitor->secondName}}</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-2">
                                        <img src="{{$visitor->accessLogBelongsToVisitor->photoUrl}}" alt="">
                                      </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger " data-dismiss="modal">Close</button>
                                  
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>                                       
                    <div class="modal fade" id="{{"checkingOutVisitor".$visitor->id}}" style="display: none;">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color: rgb(250, 128, 112)">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                              <h4 class="modal-title text-center">Checking Out Visitor : <span class="nameOfCheckingOutVisitor">{{ $visitor->accessLogBelongsToVisitor->firstName. '   '.  $visitor->accessLogBelongsToVisitor->secondName}}</span></h4>
                            </div>
                            <div class="modal-body text-center" style="background-color: rgb(250, 154, 141)">
                              Are You sure You Want To Checkout Visitor: <span  style="color:blue;" class="nameOfCheckingOutVisitor">{{ $visitor->accessLogBelongsToVisitor->firstName. '   '.  $visitor->accessLogBelongsToVisitor->secondName}}</span>
                              <br>
                              Visitor Id : <span style="color:blue;" class="idOfCheckingOutVisitor">{{$visitor->accessLogBelongsToVisitor->idNo}}</span>
                              <br>
                              Time Checked In: <span style="color:blue;" class="timeInOfCheckingOutVisitor">{{$date}}</span>
                              <br>
                            </div>
                            <div class="modal-footer"style="background-color: rgb(250, 128, 112)">
                              <button type="button" class="btn btn-info fa fa-times pull-left" data-dismiss="modal">Close</button>
                              <form action="/checkingOutVisitor" method="POST">
                                    {{ csrf_field() }}
                                  <input type="hidden" id="idOfCheckedOutVisitor" name="idOfCheckedOutVisitor" value="{{$visitor->id}}">
                                <button type="submit" class="btn btn-danger fa fa-sign-out">Check Out Visitor.</button>
                              </form>
                              
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>
                </tr>
                @endforeach  
                
                {{-- The modal that will be used for logging out users. --}}
                
            </tbody>
            <tfoot>
                <tr>
                    <th>S <sub>no</sub></th>
                    <th>Name</th>              
                    <th>Id</th>
                    <th>Time In</th>
                    <th>Company Visited</th>
                    <th>Type Of Visit</th>
                    <th>Approving Manager</th>
                    <th>Approval</th>
                    <th>Image</th>
                    <th>Check Out Visitor</th>
                  </tr>
                </tfoot>
        </table>

    </div>
</div>

@endsection