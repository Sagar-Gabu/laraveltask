<x-admin>
    @section('title', 'Product Edit')

    <div class="form-group mb-3">
        <form action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">
            
            <div class="form-group mt-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
            </div>

            <div class="form-group mt-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}">
            </div>

            <div class="form-group mt-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="description" class="form-control" value="{{ $product->description }}">
            </div>

            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="" selected disabled>Select a category</option>
                    @foreach($categories as $category)
                        <option {{ $product->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="form-group mb-3">
                <label for="Image">Image</label>
                <input type="file" name="image" id="Image" class="form-control">
            </div>

            <div class="form-group mt-3">
                <button class="btn btn-sm btn-primary">Save</button>
            </div>
        </form>
    </div>


    

</x-admin>
