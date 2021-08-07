@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <h2 class="title-2"><i class="fa fa-envelope"></i> Mensajes Recibidos </h2>

                        <div style="clear:both"></div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Mensaje</th>
                                        <th> Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--  @if ($messages == 'NULL')  --}}
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td>{{ $message->name }}</td>
                                                <td>{{ Str::limit($message->message, 50) }}</td>
                                                <td>
                                                    <p><a class="btn btn-primary btn-xs"
                                                            href="{{ route('message.response', $message) }}"> <i
                                                                class="fa fa-edit"></i>
                                                            Responder
                                                        </a></p>
                                                    <p><a class="btn btn-danger btn-xs"
                                                            href="{{ route('message.delete', $message) }}"> <i
                                                                class=" fa fa-trash"></i> Eliminar
                                                        </a></p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    {{--  @endif  --}}
                                </tbody>
                            </table>
                        </div>

                        <div style="clear:both"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
