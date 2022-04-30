@extends('layouts.mainAdminSite')

@section('content')
    @include('admin.parts._wizardAdminSite')
    @include('admin.parts._adminSite')
    @include('admin.parts._listPendingServiceAdminSite')
    @include('admin.parts._listPendingServiceSponsorAdminSite')
    @include('admin.parts._listClientAdminSite')
    {{--  @include('admin.parts._listServiceAdminSite')  --}}
@endsection