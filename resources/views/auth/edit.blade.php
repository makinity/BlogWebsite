<x-layout>
    <div class="container mt-5">
        <h1 class="text-center text-primary mb-4">Account Info</h1>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action="{{ route('edit.profile', $user->id) }}" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 500px;">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="profile" class="form-label">Attach new Picture Picture</label>
                <input type="file" name="new_profile" id="profile" class="form-control">
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="form-control" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" required>
            </div>

             <div class="mb-3">
                <label for="bio" class="form-label">Add a short Bio</label>
                <input type="text" name="bio" id="bio" value="{{ old('bio', optional($user->profile)->bio) }}" class="form-control" required>
            </div>

            <!-- Password -->
             <div class="mb-3">
                <label for="current_password" class="form-label">Old Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <!-- Password Confirmation -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-success">Update Account</button>
            </div>
        </form>
    </div>
</x-layout>
