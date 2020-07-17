@extends('approvingManager.approvingManagerExtension')

@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" > Previous Visitor Approval.</h2>
@endsection

@section('mainContent')

<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Previous Visitor Approvals..</h3>
    </div>
    <div class="box-body"> 
<table style="font-family: 'Times New Roman', Times, serif" id="example1" class="table table-hover  table-bordered table-striped">
    <thead>
    <tr>
      <th>S <sub>no</sub></th>
      <th>Name</th>              
      <th>ID</th>
      <th>Company</th>
      <th>Purpose Of Visit</th>
      <th>Approving Manager</th>
      <th>Status</th>              
    </tr>
    </thead>
    <tbody>
        {{-- $previous --}}
        @php
            $counter = 0;
        @endphp
        @if (count($previous)>0)
            @foreach ($previous as $visitor)
                    @if ($visitor->approvingManagerApproval != 0)
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
                                @if ($visitor->approvingManagerApproval == -1)
                                <p style="font-size: 14px;" class="label  bg-red">Denied</p>  
                                @elseif($visitor->approvingManagerApproval == 1)
                                <p style="font-size: 14px;" class="label  bg-green">Approved</p>  
                                @endif                              
                            </td>                          
                       </tr> 
                    @endif                
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
            <th>Status</th>              
          </tr>
    </tfoot>
</table>
    </div>
</div>

      
@endsection