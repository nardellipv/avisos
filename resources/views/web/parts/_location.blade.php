<section class="block">
    <div class="container">
        <h2>Localidades</h2>
        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">
            @foreach ($locations->chunk('5') as $locationsName)
            <ul class="categories-list clearfix">
                <li>
                    @foreach ($locationsName as $location)
                    <h4><a href="{{ route('search.listLocation', $location->slug) }}">{{ $location->name }}</a></h4>
                    @endforeach
                </li>
            </ul>
            @endforeach
        </div>
    </div>
</section>