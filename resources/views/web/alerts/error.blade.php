@if (count($errors) > 0)
<section>
    <div class="box">
        <div class="col-lg-12">
            <h3><i class="fa fa-times text-danger" aria-hidden="true"></i> Error! Por Favor
                corrige
                los siguientes errores.</h3>

            <ul>
                @foreach ($errors->all() as $error)
                <li class="text-danger list-unstyled"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                    {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@endif