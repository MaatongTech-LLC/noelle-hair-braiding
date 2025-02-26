<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('service.show', $service->id) }}" target="_blank" class="d-flex align-items-center justify-content-between">
        <div class="rounded-circle overflow-hidden">
            <img src="{{ $service->getImage() }}" style="object-fit: cover; height: 70px; width: 70px;" />
        </div>
        <span class="px-2">{{ $service->name }}</span>
    </a>
</div>
