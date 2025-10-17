<x-layout>
    <div class="container mt-5">
        <h1 class="text-center text-info mb-4">Your Posts</h1>

        @if($posts->isEmpty())
            <p class="text-center text-secondary">No posts available.</p>
        @else
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm bg-dark text-light border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-info">{{ $post->title }}</h5>
                                <p class="card-text text-light" style="flex-grow: 1;">
                                    {{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}
                                </p>

                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('show.edit', ['id' => $post->id]) }}" class="btn btn-outline-info btn-sm">Edit</a>
                                    
                                    <form action="{{ route('post.delete', $post) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
