@extends('mainPageExtension.mainpage')

@section('navigation')
    @include('adminInterfaces.adminComponenets.navigation')
@endsection

@section('aside')
    @include('adminInterfaces.adminComponenets.aside')
@endsection

@section('mainContentHeader')
    
@endsection

@section('mainContentData')
    @yield('mainContent')
@endsection

@section('footer')
    @include('adminInterfaces.adminComponenets.footer')
@endsection