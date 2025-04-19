@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            @include('web.alerts.error')
            <form action="{{ route('profile.updateProfile', $user) }}" class="form-horizontal" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    @include('web.adminUser.parts._asideMenu')
                    <div class="col-md-9">
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-image">
                                        <div class="image background-image">
                                            @if ($user->photo)
                                            <img src="{{ asset('users/' . $user->id . '/images/120x120-' . $user->photo) }}"
                                                alt="foto perfil" class="userImg">
                                            @else
                                            <img src="{{ asset('styleWeb/assets/user.png') }}" class="userImg"
                                                alt="Logo">
                                            @endif
                                        </div>
                                        <div class="single-file-input">
                                            <input type="file" id="user_image" name="photo">
                                            <div class="btn btn-framed btn-primary small">Cambiar Imágen</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label required">Nombre</label>
                                        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label required">Apellido</label>
                                        <input type="text" name="lastname" value="{{ $user->lastname }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-form-label required">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="searchable-select" class="col-form-label">Localidad</label>
                                        <select name="region_id" id="searchable-select" data-placeholder="Select"
                                            data-enable-search="true">
                                            <option value="{{ $user->region_id }}">
                                                {{ $user->region->name }}</option>
                                            <option disabled>---------------------</option>
                                            @foreach ($regions as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="type" {{ $user->recive == 'Y' ? 'checked' :
                                                '' }}>
                                                Recibir novedades del sitio
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Actualizar
                                            Datos</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>
@endsection