<x-layout>
    <div class="container mt-5">

        <h1 class="text-center text-info">Edit This Post</h1>

        <div class="card shadow-sm bg-dark text-light border-0">
            <div class="card-body"> 

                <form action="{{ route('edit', $posts->id) }}" method="POST">
                    @csrf 
                    @method('PUT')

                    {{-- Title input --}}
                    <label for="title" class="form-label text-light">Title</label>
                    <input type="text" id="title" name="title" class="form-control bg-secondary text-light border-0" 
                           value="{{ old('title', $posts->title) }}" required>

                    {{-- Content textarea --}}
                    <label for="content" class="form-label mt-3 text-light">Content</label>
                    <textarea id="content" name="content" rows="5" class="form-control bg-secondary text-light border-0" 
                              required>{{ old('content', $posts->content) }}</textarea>

                    {{-- Submit button --}}
                    <button type="submit" class="btn btn-success mt-4">Save Changes</button>
                </form>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('show.manage', $posts->user->id) }}" class="btn btn-outline-light">Back</a>
        </div>

    </div>
</x-layout>
