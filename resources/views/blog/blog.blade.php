<x-layout>
    <div class="card shadow-sm border-0 mt-5 bg-dark text-light">
        <div class="card-body text-center">
            <h5 class="card-title text-info">About the Creator</h5>
            <p class="card-text text-light">
                Hi, I'm <strong>Mark Vencent L. Juntilla</strong>, a student from Davao del Sur State College and creator of this blog system. 
                I built this platform to share ideas, stories, and resources in a clean, responsive, and accessible format.
            </p>
            <p class="text-secondary small">
                Built using Laravel, Blade Components, and Bootstrap 5.
            </p>

            <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="https://github.com/makinity" target="_blank" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-github"></i> GitHub
                </a>
                <a href="mailto:marklionesios@gmail.com" target="_blank" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-envelope"></i> Contact
                </a>
                <a href="https://www.facebook.com/facon.titan/" target="_blank" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-facebook"></i> Facebook
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-5 bg-dark text-light">
        <div class="card-body text-center">
            <h5 class="card-title text-info">Total Users:</h5>
            <p class="card-text text-secondary">{{ $users }}</p>
        </div>
    </div>
</x-layout>
