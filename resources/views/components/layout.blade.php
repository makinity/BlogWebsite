<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        .alert-success {
            background-color: #14532d;
            color: #d1fae5;
            border-color: #166534;
        }
    </style>
</head>
<body>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- Bootstrap Navbar (Dark) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('blog.info') }}">Blog Web</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Left side -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('show.home') }}">Home</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.createPost', auth()->user()->id) }}">Create Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.manage', auth()->user()->id) }}">Manage Post</a>
                        </li>
                    @endauth
                </ul>

                <!-- Right side -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('show.register') }}">Register</a>
                        </li>
                    @else
                    <!-- AI Icon -->
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('ai.chat') }}" title="AI Assistant">
                                <i class="bi bi-cpu fs-5"></i>
                            </a>
                        </li>

                        <!-- Chat Icon -->
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('chat') }}" title="Chat">
                                <i class="bi bi-chat-dots fs-5"></i>
                            </a>
                        </li>

                        <!-- Profile Picture and Name -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('storage/' . auth()->user()->profile->profile) }}"
                                    alt="{{ auth()->user()->name }}'s Profile Picture"
                                    class="rounded-circle border border-info me-2"
                                    style="width: 35px; height: 35px; object-fit: cover;">
                                <span>{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('show.profile', auth()->user()->id) }}">My Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('show.manage', auth()->user()->id) }}">Manage Posts</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="px-3">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100 btn-sm">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <!-- Content -->
    <div class="container mt-5">
        {{ $slot }}
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
