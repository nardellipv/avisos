@extends('layouts.mainAdminSite')

@section('content')
    @include('admin.parts._wizardAdminSite')
    @include('admin.parts._adminSite')
    @include('admin.parts._listClientAdminSite')
    @include('admin.parts._listServiceAdminSite')
@endsection