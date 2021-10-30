<div class="container">
    <div class="col-lg-12 content-box ">
        <div class="row row-featured">
            <div style="clear: both"></div>
            <div class=" relative  content  clearfix">
                <div class="">
                    <div class="tab-lite">
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab"
                                    data-toggle="tab"><i class="icon-location-2"></i> Localidades</a></li>
                            {{-- <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab"
                                    data-toggle="tab"><i class="icon-search"></i> Top Search</a>
                            </li>
                            <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><i
                                        class="icon-th-list"></i> Top Makes</a>
                            </li> --}}
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab1">
                                <div class="col-lg-12 tab-inner">
                                    <div class="row">
                                        @foreach ($locations->chunk('5') as $locationsName)
                                        <ul class="cat-list col-sm-3  col-xs-6 col-xxs-12">
                                            @foreach ($locationsName as $location)
                                            <li><a href="{{ route('search.listLocation', $location->slug) }}">{{ $location->name }}</a></li>
                                            @endforeach
                                        </ul>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            {{-- <div role="tabpanel" class="tab-pane" id="tab2">

                                <div class="col-lg-12 tab-inner">

                                    <div class="row">

                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>


                                        <ul class="cat-list col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Atlanta</a></li>
                                            <li><a href="category.html">Wichita </a></li>
                                            <li><a href="category.html"> Anchorage </a></li>
                                            <li><a href="category.html"> Dallas </a></li>
                                            <li><a href="category.html"> New York </a></li>
                                            <li><a href="category.html">Santa Ana/Anaheim </a></li>
                                            <li><a href="category.html"> Miami </a></li>
                                            <li><a href="category.html">Los Angeles</a></li>
                                        </ul>

                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>

                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>


                                    </div>

                                </div>


                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab3">

                                <div class="col-lg-12 tab-inner">

                                    <div class="row">


                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>


                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>


                                        <ul class="cat-list col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Atlanta</a></li>
                                            <li><a href="category.html">Wichita </a></li>
                                            <li><a href="category.html"> Anchorage </a></li>
                                            <li><a href="category.html"> Dallas </a></li>
                                            <li><a href="category.html"> New York </a></li>
                                            <li><a href="category.html">Santa Ana/Anaheim </a></li>
                                            <li><a href="category.html"> Miami </a></li>
                                            <li><a href="category.html">Los Angeles</a></li>
                                        </ul>

                                        <ul class="cat-list cat-list-border col-sm-3  col-xs-6 col-xxs-12">
                                            <li><a href="category.html">Virginia Beach </a></li>
                                            <li><a href="category.html"> San Diego </a></li>
                                            <li><a href="category.html">Boston </a></li>
                                            <li><a href="category.html">Houston</a></li>
                                            <li><a href="category.html">Salt Lake City </a></li>
                                            <li><a href="category.html">San Francisco </a></li>
                                            <li><a href="category.html">Tampa </a></li>
                                            <li><a href="category.html"> Washington DC </a></li>

                                        </ul>


                                    </div>

                                </div>


                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>