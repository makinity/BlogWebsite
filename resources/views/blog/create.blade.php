<x-layout>
    <div class="container mt-5">
        <h1 class="text-center text-info mb-4">Create Post</h1>

        <form action="{{ route('create.post', ['id' => $user->id]) }}" method="POST">
            @csrf

            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label text-light">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" 
                       class="form-control bg-secondary text-light border-0" required>
            </div>

            <!-- Content -->
            <div class="mb-3">
                <label for="content" class="form-label text-light">Content</label>
                <textarea name="content" id="content" rows="5" 
                          class="form-control bg-secondary text-light border-0" required>{{ old('content') }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Post</button>
            </div>
        </form>
    </div>
</x-layout>
