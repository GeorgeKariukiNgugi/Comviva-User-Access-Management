@extends('accessMangerInterfaces.accessManagerExtension')

@section('mainContentHeader')
    <h2 class="text-center" style="  font-decoration:underline; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif" > Visitors.</h2>
@endsection

@section('mainContent')

    @include('sharedPages.checkedOutVisitors')
      
@endsection
{{-- <h4>This is the landing page of the application for the User Access Managers.</h4> --}}