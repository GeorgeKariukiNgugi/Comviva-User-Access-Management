@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Checking Out Visitors.</h2>
@endsection
@section('mainContent')

<div class="box box-success">
    <div class="box-header">              
      <h3 class="box-title">Visitors Checked In.</h3>
    </div>
    <div class="box-body">

        <table style="font-family: 'Times New Roman', Times, serif" id="example1" class="table table-hover  table-bordered table-striped">
            <thead>
            <tr>
              <th>S <sub>no</sub></th>
              <th>Name</th>              
              <th>Id</th>
              <th>Time In</th>
              <th>Company Visited</th>
              <th>Type Of Visit</th>
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
                    <td class="text-center">
                        <button class="btn btn-info fa fa-file-image-o"> Image </button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-danger fa fa-sign-out"> Check Out Visitor</button>
                    </td>
                </tr>
                @endforeach                                                 

                 
                {{-- <div class="row">
                <div class="col-md-4">
                    Approved By: 
                </div>
                <div class="col-md-8">
                    {{ $visitor->accessLogHasOneApprover->firstName. '  '. $visitor->accessLogHasOneApprover->secondName }}
                </div>
                </div> --}}                
            </tbody>
            <tfoot>
                <tr>
                    <th>S <sub>no</sub></th>
                    <th>Name</th>              
                    <th>Id</th>
                    <th>Time In</th>
                    <th>Company Visited</th>
                    <th>Type Of Visit</th>
                    <th>Image</th>
                    <th>Check Out Visitor</th>
                  </tr>
                </tfoot>
        </table>

    </div>
</div>

@endsection