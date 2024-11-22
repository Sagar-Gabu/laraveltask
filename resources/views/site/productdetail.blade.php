<x-site>
    @section('title', $product->name)

    <div class="container my-5">
        <!-- Product Detail -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <img src="{{ asset('images/'.$product->image) }}" class="img-fluid" alt="{{ $product->name }}"  style="height: 500px; object-fit: cover;">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mt-4 mt-md-0">
                <h2>{{ $product->name }}</h2>
                
                <!-- Price with Label -->
                <div class="mb-3">
                    <strong>Price:</strong> 
                    <span class="text-muted">&#8377;{{ $product->price }}</span>
                </div>
                
                <!-- Description with Label -->
                <div class="mb-3">
                    <strong>Description:</strong>
                    <p>{{ $product->description }}</p>
                </div>
                
                <a href="#" class="btn btn-primary">Add to Cart</a>
            </div>
        </div>

        <!-- Related Products -->
        <div class="row mt-5">
            <h3 class="text-center mb-4 font-weight-bold">Related Products</h3>
            <div class="row">
                @forelse ($relatedProducts as $relatedProduct)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card shadow-sm border-0">
                            <img src="{{ asset('images/'.$relatedProduct->image) }}" class="card-img-top" alt="{{ $relatedProduct->name }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                                <p class="text-muted">&#8377;{{ $relatedProduct->price }}</p>
                                <a href="{{ route('site.productdetail', ['category' => $relatedProduct->category->slug, 'slug' => $relatedProduct->slug]) }}" class="btn btn-outline-primary btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted">No related products available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-site>
