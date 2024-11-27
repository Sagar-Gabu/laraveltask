<x-admin>
    @section('title', 'Category Create')

    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data" id="create" class="needs-validation" novalidate>
        @csrf
        <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary float-end mb-5">Back</a>

        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</x-admin>
