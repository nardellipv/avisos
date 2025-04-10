<section class="block">
    <div class="container">
        <h2>Categorías</h2>
        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">
            <ul class="categories-list clearfix">
                @foreach ($categories as $category)
                <li>
                    <i class="category-icon">
                        <img src="{{ asset('styleWeb/assets/imgCat/' . $category->slug . '.png') }}" alt="{{ $category->slug }}" title="{{ $category->slug }}">
                    </i>
                    <h4><a href="{{ route('category.listCategory', $category->slug) }}" rel="canonical">{{ Str::limit($category->name,
                            15) }} ({{ $category->services_count }})</a></h4>
                </li>
                @endforeach
                <li>
                    <i class="category-icon">
                        <img src="{{ asset('styleWeb/assets/imgCat/categories_all.png') }}" alt="todas categorias" title="todas las categorias" rel="canonical">
                    </i>
                    <h4><a href="{{ route('category.index') }}">Listado Completo</a></h4>
                </li>
            </ul>
        </div>
    </div>
</section>