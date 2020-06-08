@extends('mainPageExtension.mainpage')

@section('navigation')
    @include('accessMangerInterfaces.accessmanagerComponenets.navigation')
@endsection

@section('aside')
    @include('accessMangerInterfaces.accessmanagerComponenets.aside')
@endsection

@section('mainContentHeader')
    
@endsection

@section('mainContentData')
    @yield('mainContent')
@endsection

@section('footer')
    @include('accessMangerInterfaces.accessmanagerComponenets.footer')
@endsection