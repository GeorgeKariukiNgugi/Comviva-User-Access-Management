@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" >Trends For Visitor.</h2>
@endsection
@section('charts')
{!! $chart->script() !!}
@endsection
@section('mainContent')
   
    <h2>This is the trends page.</h2>
    <div style="width: 50%">
        {!! $chart->container() !!}
    </div>

@endsection