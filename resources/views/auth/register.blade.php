<x-layout>
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Register</h1>

        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 500px;">
            @csrf
            <div class="mb-3">
                <label for="profile" class="form-label">Attach Profile Picture</label>
                <input type="file" name="profile" id="profile" value="{{ old('profile') }}" class="form-control" required>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Add a short Bio</label>
                <input type="text" name="bio" id="bio" value="{{ old('bio') }}" class="form-control" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <!-- Password Confirmation -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Register</button>
                <a href="{{ route('access.google') }}" class="btn btn-primary btn-lg text-white">Register with Google</a>
            </div>
        </form>
    </div>
</x-layout>
