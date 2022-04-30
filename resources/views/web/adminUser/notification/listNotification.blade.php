@extends('layouts.mainAdminSite')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">

<link rel="stylesheet" href="{{ asset('admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Crear Notificación</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('adminNotification.createNotification') }}" class="form-horizontal" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Título</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fecha fin</label>
                                    <input type="text" name="date" class="form-control datepicker">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Notificación</label>
                                <textarea name="body" class="form-control"></textarea>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Enviar notificación</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>



<section class="section">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Listado Notificaciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Notificación</th>
                                        <th>Fecha Fin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                    <tr>
                                        <td>{{ $notification->title }}</td>
                                        <td>{{ Str::limit($notification->body, 150) }}</td>
                                        <td>{{ $notification->date }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('admin/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
</script>
<script src="{{ asset('admin/assets/js/page/datatables.js') }}"></script>

<script src="{{ asset('admin/assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"></script>
<script src="{{ asset('admin/assets/bundles/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endsection