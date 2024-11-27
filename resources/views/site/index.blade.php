<x-site>
    @section('title', 'Home')

    <div class="container my-5">
        <!-- Page Header -->
        <div class="text-center mb-4">
            <h1 class="display-4">Product Overview</h1>
            <p class="text-muted">Browse through our wide range of products</p>
        </div>

        <!-- Main Layout: Sidebar + Products Grid -->
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="bg-light p-3 rounded shadow-sm">
                    <h5 class="mb-3">Categories</h5>
                    <ul class="list-unstyled">
                        <!-- All Products Link -->
                        <li class="mb-2">
                            <a href="{{ route('site.shop') }}" 
                               class="text-decoration-none {{ !request()->get('category') ? 'fw-bold text-primary' : '' }}">
                                All Products
                            </a>
                        </li>

                        <!-- Dynamic Category Links -->
                        @foreach ($categories as $category)
                            <li class="mb-2 d-flex align-items-center">
                                <a href="{{ route('site.shop', ['category' => $category->slug]) }}" 
                                   class="text-decoration-none {{ request()->get('category') === $category->slug ? 'fw-bold text-primary' : '' }}">
                                    <img 
                                        class="me-2 rounded" 
                                        src="{{ asset('images/' . ($category->image ?? 'default-category.png')) }}" 
                                        alt="{{ $category->name }}" 
                                        height="30">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-md-9">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-100">
                                <!-- Product Image -->
                                <img src="{{ asset('images/' . ($product->image ?? 'default.jpg')) }}" 
                                     class="card-img-top" 
                                     alt="{{ $product->name }}" 
                                     style="height: 250px; object-fit: cover;">
                                <!-- Product Details -->
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="text-muted">&#8377;{{ number_format($product->price, 2) }}</p>
                                    <a href="{{ route('site.productdetail', ['category' => $product->category->slug ?? 'default', 'slug' => $product->slug]) }}" 
                                       class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State -->
                        <div class="col-12">
                            <p class="text-center text-muted">No products available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-site>
