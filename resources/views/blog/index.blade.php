<x-layout>       
    <style>
        .pagination {
            background-color: #212529;
            border-radius: 0.25rem;
            padding: 0.25rem 0.5rem;
        }
        .pagination .page-link {
            color: #0dcaf0;
            background-color: #212529;
            border: 1px solid #0dcaf0;
        }
        .pagination .page-link:hover,
        .pagination .page-link:focus {
            color: #fff;
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }
        .pagination .page-item.active .page-link {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            color: #000;
        }
        .pagination .page-item.disabled .page-link {
            color: #6c757d;
            background-color: #212529;
            border-color: #212529;
        }
    </style>

    <!-- Page Header -->
    <header class="mb-5 text-center">
        <h1 class="text-info fw-bold">Home Page</h1>
        <p class="text-secondary">Welcome to the blog! Check out the latest posts below.</p>
    </header>

    <!-- Posts Section -->
    @if($posts->isNotEmpty())
        <section class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($posts as $post)
                <div class="col">
                    <div class="card h-100 shadow-sm bg-dark text-light border-0">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-info">{{ $post->title }}</h5>
                            <p class="card-text text-light flex-grow-1">
                                {{ Str::limit($post->content, 150) }}
                            </p>
                            <div class="mt-3 d-flex align-items-center justify-content-between">
                                <div class="text-light d-flex align-items-center gap-3">
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-chat-dots me-1"></i> {{ $post->comments->count() }}
                                    </span>
                                    <span class="d-flex align-items-center">
                                        <i class="bi bi-hand-thumbs-up me-1" style="font-size: 1.3rem;"></i> {{ $post->likes->count() }}
                                    </span>
                                </div>
                                <a href="{{ route('show.post', ['id' => $post->id]) }}" class="btn btn-outline-info btn-sm">
                                    View Post
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </section>
    @else
        <!-- Empty State -->
        <div class="text-center mt-5">
            <p class="text-secondary fs-5">🚫 No posts available at the moment.</p>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination pagination-sm">
                {{ $posts->onEachSide(1)->links() }}
            </ul>
        </nav>
    </div>

</x-layout>
