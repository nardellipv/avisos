@if (count($errors) > 0)
    <div class="inner-box category-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success pgray  alert-lg" role="alert">
                    <h2 class="no-margin no-padding"><i class="fa fa-times" aria-hidden="true"></i> Error! Por Favor
                        corrige
                        los siguientes errores.</h2>

                    <ul style="margin-left: 10%;margin-top: 3%;font-size: 15px;">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                                {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
