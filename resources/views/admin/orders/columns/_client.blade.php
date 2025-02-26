<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
    <a href="{{ route('admin.clients.show', $order->user->id) }}" target="_blank" class="d-flex flex-column align-items-start justify-content-between">
        <span>{{ $order->user->name }}</span>
        <small class="px-2 text-secondary">{{ $order->user->email }}</small>
    </a>
</div>
