<x-site>
    @section('title', 'Home')

    <div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="display-4">Product Overview</h1>
            <p class="text-muted">Browse through our wide range of products</p>
        </div>

        <!-- Categories Filter -->
        <div class="d-flex justify-content-center flex-wrap mb-5">
            <a href="{{ route('site.shop') }}" 
               class="btn btn-outline-primary mx-2 my-1 {{ !request()->get('category') ? 'active' : '' }}">
                All Products
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('site.shop', ['category' => $category->slug]) }}" 
                   class="btn btn-outline-primary mx-2 my-1 {{ request()->get('category') === $category->slug ? 'active' : '' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="row">
            @forelse ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3 mb-4">
                    <div class="card h-100">
                        <!-- Product Image -->
                        <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" 
                             class="card-img-top" 
                             alt="{{ $product->name }}" 
                             style="height: 250px; object-fit: cover;">
                        <!-- Product Details -->
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-muted">&#8377;{{ $product->price }}</p>
                            <a href="{{ route('site.productdetail', ['category' => $product->category->slug ?? 'default', 'slug' => $product->slug]) }}" 
                               class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No products available.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-site>
