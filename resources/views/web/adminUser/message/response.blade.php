@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-md-8">
                    <div class="inner-box">
                        @include('web.alerts.error')
                        <div class="contact-form">
                            <h5 class="list-title gray"><strong>Responder a {{ $message->name }}</strong></h5>

                            <h4>Mensaje:</h4>
                            <h6>{{ $message->message }}</h6>

                            <form class="form-horizontal" method="post" action="{{ route('message.responseSendEmail') }}">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea class="form-control" id="message" name="messageResponse"
                                                        placeholder="El mesanje será enviado al mail del cliente"
                                                        rows="7"></textarea>
                                                </div>
                                                <input name="name" value="{{ $message->name }}" readonly hidden>
                                                <input name="email" value="{{ $message->email }}" readonly hidden>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 ">
                                                    <button type="submit" class="btn btn-success btn-lg">Responder</button>
                                                    <a href="{{ route('message.list') }}" type="submit" class="btn btn-link btn-lg">Volver</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
