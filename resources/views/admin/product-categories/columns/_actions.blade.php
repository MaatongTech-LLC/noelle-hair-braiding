<div class="btn-group">
    <button type="button" class="btn btn-primary">Actions</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" style="z-index: 999;">
        <li><a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">Edit</a></li>
        <li><a class="dropdown-item" href="{{ route('admin.categories.destroy', $category->id) }}" data-confirm-delete="true">Delete</a></li>
    </ul>
</div>
