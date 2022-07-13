@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-md-9">
                    @include('web.alerts.error')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab"
                                aria-controls="one" aria-expanded="true">Mensajes No Contestados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab"
                                aria-controls="two">Mensajes Respondidos</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
                            @forelse ($messagesNoRead as $messageNoRead)
                            <div id="messaging__chat-window" class="messaging__box">
                                <div class="messaging__header">
                                    <div class="float-left flex-row-reverse messaging__person">
                                        <h5 class="font-weight-bold"> {{ $messageNoRead->name }} </h5>
                                    </div>
                                    <div class="float-right messaging__person">
                                        <a href="{{ route('message.delete', $messageNoRead) }}"
                                            class="btn btn-light small">Eliminar Mensaje </a>
                                    </div>
                                </div>
                                <div class="messaging__content" data-background-color="rgba(0,0,0,.05)">
                                    <div class="messaging__main-chat">
                                        <div class="messaging__main-chat__bubble">
                                            <p>
                                                {{ Str::limit($messageNoRead->message, 50) }}
                                                <small>{{ \Carbon\Carbon::parse($messageNoRead->created_at)->diffforhumans()
                                                    }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="messaging__footer" style="margin-bottom: 2rem;">
                                    <form class="form" action="{{ route('message.response', $messageNoRead) }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" name="response" class="form-control mr-4"
                                                placeholder="Respuesta">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Enviar <i
                                                        class="fa fa-send ml-3"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @empty
                            <p>No tienes mensajes sin responder.</p>
                            @endforelse
                        </div>
                        <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                            @forelse ($messagesRead as $messageRead)
                            <div id="messaging__chat-window" class="messaging__box">
                                <div class="messaging__header">
                                    <div class="float-left flex-row-reverse messaging__person">
                                        <h5 class="font-weight-bold"> {{ $messageRead->name }} </h5>
                                    </div>
                                    <div class="float-right messaging__person">
                                        <a href="{{ route('message.delete', $messageRead) }}"
                                            class="btn btn-light small">Eliminar Mensaje </a>
                                    </div>
                                </div>
                                <div class="messaging__content" data-background-color="rgba(0,0,0,.05)">
                                    <div class="messaging__main-chat">
                                        <div class="messaging__main-chat__bubble">
                                            <p>
                                                {{ Str::limit($messageRead->message, 50) }}
                                                <small>{{ \Carbon\Carbon::parse($messageRead->created_at)->diffforhumans()
                                                    }}</small>
                                            </p>
                                        </div>
                                        <div class="messaging__main-chat__bubble user">
                                            <p>
                                                {{ $messageRead->response }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="messaging__footer" style="margin-bottom: 2rem;">
                                </div>
                            </div>
                            @empty
                            <p>Sin mensajes respondidos.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection