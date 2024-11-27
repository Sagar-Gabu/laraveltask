<x-admin>
    @section('title', 'Products')

    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-end">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Create</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Cat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr id="product-row-{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <td><img height="50" src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}"></td>
                        <td>{{ $product->name }}</td>
                        <td>&#8377;{{ $product->price }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ optional($product->category)->name }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('admin.product.destroy', $product) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th class="bg-danger text-center text-white" colspan="8">No products available.</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin>