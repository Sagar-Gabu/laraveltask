<x-admin>

    @section('title','Category Edit')
    <form id="categoryForm" method="POST" class="needs-validation" novalidate>
        @method('PUT')
        @csrf
        <div class="form-group mb-3">
        <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary float-end mb-5">Back</a>

            <label for="name" class="form-label">Edit category</label>
            <div class="form-group mt-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            </div>

            <div class="form-group mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
           
        </div>
        <div class="form-group mb-3">
            <button class="btn btn-primary" id="submitBtn" type="button">Save</button>
        </div>
    </form>
</x-admin>
