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
                        <td>&#8377;{{ number_format($product->price, 2) }}</td>
                        <td>{{ Str::limit($product->description, 50) }}</td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ optional($product->category)->name }}</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-success">Edit</a>
                            <button class="btn btn-danger deletebtn" type="button" data-id="{{ $product->id }}" data-url="{{ route('admin.product.destroy', $product->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
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

    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '.deletebtn', function() {
            let url = $(this).data('url');
            let id = $(this).data('id');

        
            $('#deleteForm').attr('action', url);
        });

        $('#deleteForm').on('submit', function(e) {
            e.preventDefault(); 

            let url = $(this).attr('action');
            
            $.ajax({
                url: url,
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#product-row-' + response.id).fadeOut(500, function() {
                        $(this).remove();
                    });
                    $('#deleteModal').modal('hide'); 
                },
                error: function(xhr) {
                    alert("Error deleting the product: " + xhr.responseText);
                }
            });
        });
    </script>
</x-admin>
