@extends('layouts.app')

@section('title', 'Daftar Akun')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="brand-icon-lg">
                <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <h1>Buat Akun</h1>
            <p>Bergabung dengan MyNotes sekarang</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <strong>Terdapat beberapa kesalahan:</strong>
                    </div>
                    <ul class="mb-0 ps-3" style="font-size:.85rem">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium" style="font-size:.88rem">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius:8px 0 0 8px">
                            <i class="bi bi-person text-muted" style="font-size:.9rem"></i>
                        </span>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control border-start-0 @error('name') is-invalid @enderror"
                            placeholder="Nama lengkap kamu"
                            autocomplete="name"
                            autofocus
                            style="border-radius:0 8px 8px 0"
                        >
                    </div>
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium" style="font-size:.88rem">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius:8px 0 0 8px">
                            <i class="bi bi-envelope text-muted" style="font-size:.9rem"></i>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control border-start-0 @error('email') is-invalid @enderror"
                            placeholder="nama@email.com"
                            autocomplete="email"
                            style="border-radius:0 8px 8px 0"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-medium" style="font-size:.88rem">
                        Password <span class="text-muted fw-normal">(min. 8 karakter)</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius:8px 0 0 8px">
                            <i class="bi bi-lock text-muted" style="font-size:.9rem"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                            placeholder="Buat password kuat"
                            autocomplete="new-password"
                        >
                        <button type="button" class="input-group-text bg-light border-start-0 toggle-pwd" data-target="password" style="border-radius:0 8px 8px 0;cursor:pointer">
                            <i class="bi bi-eye text-muted" style="font-size:.9rem"></i>
                        </button>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-medium" style="font-size:.88rem">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0" style="border-radius:8px 0 0 8px">
                            <i class="bi bi-lock-fill text-muted" style="font-size:.9rem"></i>
                        </span>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control border-start-0 border-end-0"
                            placeholder="Ulangi password"
                            autocomplete="new-password"
                        >
                        <button type="button" class="input-group-text bg-light border-start-0 toggle-pwd" data-target="password_confirmation" style="border-radius:0 8px 8px 0;cursor:pointer">
                            <i class="bi bi-eye text-muted" style="font-size:.9rem"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-person-check me-1"></i> Buat Akun
                </button>
            </form>

            <div class="divider-text mt-4">
                <span>Sudah punya akun?</span>
            </div>

            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 py-2 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-pwd').forEach(btn => {
        btn.addEventListener('click', () => {
            const id    = btn.dataset.target;
            const input = document.getElementById(id);
            const eye   = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                eye.className = 'bi bi-eye-slash text-muted';
            } else {
                input.type = 'password';
                eye.className = 'bi bi-eye text-muted';
            }
        });
    });
</script>
@endpush
