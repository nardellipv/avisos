@extends('layouts.mainAdminSite')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Enviar Notificaciones Push</h4>
                        </div>
                        <form action="{{ route('adminPush.send') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" name="url" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Texto</label>
                                    <textarea name="text" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Enviar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
