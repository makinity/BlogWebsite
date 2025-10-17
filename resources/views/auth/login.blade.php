<x-layout>
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Login</h1>

        <form action="{{ route('login') }}" method="POST" class="mx-auto" style="max-width: 400px;">
            @csrf

            <!-- Username -->
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-3 mb-3">
                <button type="submit" class="btn btn-success btn-lg">Login</button>
                <a href="{{ route('access.google') }}" class="btn btn-primary btn-lg text-white">Login with Google</a>
            </div>

            @if($errors->any())
            <ul class="list-unstyled px-3 py-2 bg-danger bg-opacity-10 rounded">
                @foreach($errors->all() as $error)
                    <li class="my-1 text-danger">{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </form>
    </div>
</x-layout>
