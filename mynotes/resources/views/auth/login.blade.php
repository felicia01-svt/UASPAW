@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-header">
            <div class="brand-icon-lg">
                <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <h1>MyNotes</h1>
            <p>Catatan pribadi yang terorganisir</p>
        </div>

        {{-- Body --}}
        <div class="auth-body">

            {{-- Flash Error --}}
            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-medium" style="font-size:.88rem">
                        Email
                    </label>
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
                            autofocus
                            style="border-radius:0 8px 8px 0"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label fw-medium mb-0" style="font-size:.88rem">
                            Password
                        </label>
                    </div>
                    <div class="input-group mt-1">
                        <span class="input-group-text bg-light border-end-0" style="border-radius:8px 0 0 8px">
                            <i class="bi bi-lock text-muted" style="font-size:.9rem"></i>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                        >
                        <button
                            type="button"
                            class="input-group-text bg-light border-start-0 toggle-password"
                            data-target="password"
                            style="border-radius:0 8px 8px 0;cursor:pointer"
                        >
                            <i class="bi bi-eye text-muted" id="eye-password" style="font-size:.9rem"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>

            <div class="divider-text mt-4">
                <span>Belum punya akun?</span>
            </div>

            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 py-2 fw-semibold">
                <i class="bi bi-person-plus me-1"></i> Buat Akun Baru
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const id    = btn.dataset.target;
            const input = document.getElementById(id);
            const eye   = document.getElementById('eye-' + id);
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
