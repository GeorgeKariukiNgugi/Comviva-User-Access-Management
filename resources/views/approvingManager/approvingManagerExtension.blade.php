@extends('mainPageExtension.mainpage')

@section('navigation')
    @include('approvingManager.approvingManagerComponents.navigation')
@endsection

@section('aside')
    @include('approvingManager.approvingManagerComponents.aside')
@endsection

@section('mainContentHeader')
    
@endsection

@section('mainContentData')
    @yield('mainContent')
@endsection

@section('footer')
    @include('approvingManager.approvingManagerComponents.footer')
@endsection