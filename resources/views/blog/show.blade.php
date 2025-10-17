<x-layout>
    <div class="container mt-5">

        <div class="card shadow-sm border-0 bg-dark text-light">
            <div class="card-body">

                {{-- Post Title --}}
                <h2 class="card-title text-center text-info mb-4">
                    {{ $post->title }}
                </h2>

                {{-- Post Meta Info --}}
                <div class="d-flex justify-content-between mb-3 text-muted small text-secondary">
                    <div>
                        <i class="bi bi-person-circle"></i> <strong>Posted by:</strong> {{ $post->user->name }}
                    </div>
                    <div>
                        <i class="bi bi-clock"></i> {{ $post->created_at->format('F j, Y - g:i A') }}
                    </div>
                </div>

                {{-- Post Content --}}
                <p class="card-text fs-5">
                    {{ $post->content }}
                </p>

            </div>
        </div>
        
    </div>

     {{-- Comments Section --}}
    <div class="container mt-5">
        <div class="card shadow-sm border-0 bg-dark text-light mb-4">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-info mb-0">
                        <i class="bi bi-chat-dots"></i> Comments
                    </h4>

                    <h4 class="text-info mb-0">
                        <form action="{{ route('like', $post->id) }}" method="POST">
                            @csrf 
                            <button type="submit" class="btn btn-sm btn-outline-info border-0 p-0 m-0 align-middle" style="background: none;">
                                <strong>{{ $likesCount }}</strong> <i class="bi bi-hand-thumbs-up" style="font-size: 1.7rem;"></i>
                            </button>
                        </form>
                    </h4>
                </div>

                @foreach($comments as $comment)
                    <div class="mb-4 pb-3 border-bottom">
                        <h5 class="text-info fw-bold mb-1">
                            <i class="bi bi-person-circle me-1"></i> {{ $comment->user->name }}
                        </h5>
                        <p class="text-light">{{ $comment->comment }}</p>
                    </div>
                @endforeach
                <form action="{{ route('comment', [$post->id, Auth::id()]) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="input-group">
                        <span class="input-group-text bg-secondary text-white border-0">
                            <i class="bi bi-chat-left-text"></i>
                        </span>
                        <input 
                            type="text" 
                            name="comment" 
                            class="form-control bg-dark text-light border-secondary" 
                            placeholder="Write a comment..." 
                            required
                        >
                        <button type="submit" class="btn btn-info text-dark">
                            <i class="bi bi-send-fill"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Back to Home Button --}}
    <div class="container text-center mt-4 mb-5">
        <a href="{{ route('show.home') }}" class="btn btn-outline-info px-4">
            <i class="bi bi-arrow-left-circle"></i> Back to Home
        </a>
    </div>
</x-layout>
