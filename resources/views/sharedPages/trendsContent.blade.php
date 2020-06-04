@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Trends For Visitors.</h2>
@endsection
@section('charts')
{!! $groupedCompanyBarChart->script() !!}
{!! $groupedBarChartForCompanyBasedOnMonths->script() !!}
{!! $groupedTypeOfVisitorBarChart->script() !!}


@endsection
@section('mainContent')

        <h3 style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="text-center">Trends Of Visitors Per Month.</h3>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-danger ">
                <div class="box-header">
                <h3 class="box-title text-center">Trends For the Current Month.</h3>
                </div>
                <div class="box-body">
                
                    <div>
                        {!! $groupedBarChartForCompanyBasedOnMonths->container() !!}
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
        <br>

        <h3 style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="text-center">Trends Of Visitors By Company.</h3>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-danger ">
                <div class="box-header">
                <h3 class="box-title text-center">Trends For the Current Month.</h3>
                </div>
                <div class="box-body">
                
                    <div>
                        {!! $groupedCompanyBarChart->container() !!}
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
        </div>
        <br>

        <h3 style="font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" class="text-center">Trends Of Visitors By Type Of Visitor.</h3>
        <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-danger ">
                <div class="box-header">
                <h3 class="box-title text-center">Trends For the Current Month.</h3>
                </div>
                <div class="box-body">
                
                    <div>
                        {!! $groupedTypeOfVisitorBarChart->container() !!}
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </div>
        </div>
        <br>           
@endsection