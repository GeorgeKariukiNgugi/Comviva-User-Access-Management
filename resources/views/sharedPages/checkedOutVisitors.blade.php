<div style="text-align: center">

    <a href="#0">1. Click To Go To Visitors Today.</a><br>
    <a href="#1">2. Click To Go To Visitors Yesterday.</a><br>
    <a href="#2"> 3. Click To Go To Visitors This Month.</a><br>

</div>

@for($x = 0; $x<3; $x++)
    <hr id="{{$x}}">    
    <h3 style="text-align: center;">{{$visitorArrayHeader[$x]}}</h3>
<div class="box box-success" >
    <div class="box-header">              
      <h3 class="box-title">{{$visitorArrayHeader[$x]}}</h3>
    </div>
    <div class="box-body"> 
<table style="font-family: 'Times New Roman', Times, serif" class="table example1 table-hover  table-bordered table-striped">
    <thead>
    <tr>
      <th>S <sub>no</sub></th>
      <th>Name</th>              
      <th>ID</th>
      <th>Company</th>
      <th>Purpose Of Visit</th>
      <th>Approving Manager</th>
      <th>Time In</th>
      <th>Time Out</th>
      <th>Status</th>
      <th>Checked out By</th>              
    </tr>
    </thead>
    <tbody>
      
       @php
       $counter = 0;
       $visitorsAwaitingApproval = $visitorsArray[$x];
    //    dd($visitorsAwaitingApproval);
   @endphp
   @if (count($visitorsAwaitingApproval)>0)
        {{-- <p>There is data.</p> --}}
       @foreach ($visitorsAwaitingApproval as $visitor)                     
                   @php
                       $counter++;
                   @endphp
                  <tr>
                       <td>
                           {{$counter}}
                       </td>
                       <td>
                           {{ $visitor->accessLogBelongsToVisitor->firstName. '   '.  $visitor->accessLogBelongsToVisitor->secondName}}
                       </td>
                       <td>
                           {{$visitor->accessLogBelongsToVisitor->idNo}}
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
                       <td>
                           @php
                                $dateToFormat = date_create( $visitor->timeIn);
                                $date = date_format($dateToFormat, "D-d-F-Y H:i:s"); 
                           @endphp
                            
                            {{$date}}
                       </td>
                       <td>
                        
                           @if ($visitor->approvingManagerApproval == -1)
                              <p style="color:red">{{"Not Check In."}}</p>
                           @else                           
                                    @if ($visitor->TimeOut == null)
                                        <p style="text-align: center">{{"-"}}</p>
                                    @else
                                    @php
                                        // $dateToFormat = date_create( $visitor->TimeOut);
                                        // $date = date_format($dateToFormat, "D-d-F-Y H:i:s");                                                                                
                                        $dateToFormats = date_create($visitor->TimeOut);
                                        $dates = date_format($dateToFormats, "D d-F-Y H:i:s"); 
                                    @endphp
                                    {{$dates}}
                                    @endif
                                    
                                     
                           @endif
                                                
                       </td>
                       <td>
                        @if ($visitor->approvingManagerApproval == -1)
                        <p style="font-size: 14px;" class="label  bg-red">Denied</p>  
                        @elseif($visitor->approvingManagerApproval == 1)
                        <p style="font-size: 14px;" class="label  bg-green">Approved</p>  
                        @elseif($visitor->approvingManagerApproval == 0)
                        <p style="font-size: 14px;" class="label  bg-aqua">Waiting</p> 
                        @endif
                       </td>
                       <td>
                            @if ($visitor->checkedOutById  == null)
                                {{"-"}}
                            @else
                            {{$visitor->accessLogHasOneCheckOutApprover->firstName.'  '.$visitor->accessLogHasOneCheckOutApprover->secondName}}
                            @endif
                            
                       </td>

                  </tr>                              
       @endforeach
   @else
       
   @endif       
    </tbody>
    <tfoot>
        <tr>
            <th>S <sub>no</sub></th>
            <th>Name</th>              
            <th>ID</th>
            <th>Company</th>
            <th>Purpose Of Visit</th>
            <th>Approving Manager</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Status</th>
            <th>Checked out By</th>             
          </tr>
    </tfoot>
</table>
    </div>
</div>
@endfor
