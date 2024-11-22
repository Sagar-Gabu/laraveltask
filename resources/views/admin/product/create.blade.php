<x-admin>
    @section('title','Products create')
    <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-primary float-end mb-5">Back</a>

    <div class="card-body mt-5">
        <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="price">Price</label>
                <input type="text" name="price" id="price" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="category">Category</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="" selected disabled>Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group mb-3">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

        
            <div class="form-group">
                <button class="btn btn-primary" type="submit" id="submit">Save</button>
            </div>
        </form>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    

</x-admin>
