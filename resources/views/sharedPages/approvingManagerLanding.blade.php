<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Visitors Awaiting Approval.</h3>
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
      <th>Approve</th>
      <th>Deny</th>              
    </tr>
    </thead>
    <tbody>
        @php
            $counter = 0;
        @endphp
        @if (count($visitorsAwaitingApproval)>0)
            @foreach ($visitorsAwaitingApproval as $visitor)
                    @if ($visitor->approvingManagerApproval == 0)
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
                                <form action="/approvingManagerApproval" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="idOfApproval" value="{{$visitor->id}}">
                                    <button type="submit" class="btn btn-success"> <i class=""></i> Approve</button>
                                </form>                                
                            </td>
                            <td>
                                <form action="/denyManagerApproval" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="idOfApproval" value="{{$visitor->id}}">
                                    <button type="submit" class="btn btn-danger"> <i class=""></i> Deny</button>
                                </form>                                  
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
            <th>Approve</th>
            <th>Deny</th>            
          </tr>
    </tfoot>
</table>
    </div>
</div>
