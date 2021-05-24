@extends('layouts.main')

@section('content')
    @include('web.parts._browserCategories')
    @include('web.parts._lastServices')
    {{--  @include('web.parts._location')  --}}
    {{--  @include('web.parts._banner')  --}}
    @include('web.parts._howWork')
    @include('web.parts._suscribe')
@endsection