<x-layout>
    <div class="container py-4">
        <h2 class="mb-3">💬 Available Users</h2>

        <div class="list-group">
            @foreach ($users as $user)
                <a href="{{ route('chat.user', $user->id) }}" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <span>{{ $user->name }}</span>
                    <span class="badge bg-primary">Chat</span>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
