<x-layout>
    <div class="container mt-5">
        <div class="card mx-auto bg-dark text-light border-0 shadow" style="max-width: 600px;">
            <div class="card-body">

                <h5 class="card-title mb-4 text-info border-bottom pb-2">User Details</h5>

                @if($user->profile && $user->profile->profile)
                    @php
                        $profilePath = optional($user->profile)->profile ?? 'default.jpg';
                    @endphp

                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('storage/profiles/' . $profilePath) }}" 
                            alt="{{ $user->name }}'s Profile Picture" 
                            class="rounded-circle border border-info" 
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                @else
                    <p class="text-center text-muted fst-italic mb-4">No profile picture found.</p>
                @endif

                @if($user->profile && $user->profile->bio)
                    <p class="text-center fst-italic mb-4" style="font-size: 1.1rem;">
                        {{ $user->profile->bio }}
                    </p>
                @endif

                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between">
                        <span><strong>Name:</strong></span> 
                        <span>{{ $user->name }}</span>
                    </li>
                    <li class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between">
                        <span><strong>Email:</strong></span> 
                        <span>{{ $user->email }}</span>
                    </li>
                    <li class="list-group-item bg-dark text-light border-secondary d-flex justify-content-between">
                        <span><strong>Password:</strong></span> 
                        <span><em>Hidden for security</em></span>
                    </li>
                </ul>

                <div class="text-center">
                    <a href="{{ route('show.editProfile', $user->id) }}" class="btn btn-outline-info px-4">
                        Edit Account
                    </a>
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('show.home') }}">
                ← Back
            </a>
        </div>
    </div>
</x-layout>
