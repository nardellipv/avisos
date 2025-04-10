@extends('layouts.main')

@section('content')
    @include('web.parts._browserCategories')
    @include('web.parts._outstanding')
    @include('web.parts._soponsor')
    @include('web.parts._lastServices')
    {{--  @include('web.parts._location')  --}}
    @include('web.parts._howWork')
    @include('web.parts._suscribe')
    @include('web.parts._legend')
@endsection