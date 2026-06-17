@extends('layouts.app')

@section('title', 'Edit Catatan')

@section('content')

{{-- Navbar --}}
<nav class="mynotes-navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="mynotes-brand">
                <div class="brand-icon">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                MyNotes
            </a>
            <div class="d-flex align-items-center gap-3">
                <div class="user-badge d-none d-sm-flex">
                    <i class="bi bi-person-circle"></i>
                    {{ Auth::user()->name }}
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1" style="font-size:.82rem;padding:.35rem .75rem">
                        <i class="bi bi-box-arrow-right"></i>
                        <span class="d-none d-sm-inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb" style="font-size:.83rem">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <i class="bi bi-house me-1"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">Edit Catatan</li>
        </ol>
    </nav>

    {{-- Form Card --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card-mynotes p-4">

                {{-- Card Header --}}
                <div class="d-flex align-items-center gap-3 mb-4 pb-3" style="border-bottom:1px solid var(--border)">
                    <div style="width:42px;height:42px;background:#fff3cd;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#856404;font-size:1.1rem;flex-shrink:0">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0" style="font-size:1.1rem">Edit Catatan</h4>
                        <p class="text-muted mb-0" style="font-size:.82rem">
                            Dibuat: {{ $note->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <i class="bi bi-exclamation-circle-fill"></i>
                            <strong>Mohon periksa kembali:</strong>
                        </div>
                        <ul class="mb-0 ps-3" style="font-size:.85rem">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Judul --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-medium" style="font-size:.88rem">
                            Judul Catatan <span class="text-danger">*</span>
                        </label>
                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            value="{{ old('judul', $note->judul) }}"
                            class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Masukkan judul catatan..."
                            autofocus
                        >
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Isi --}}
                    <div class="mb-4">
                        <label for="isi" class="form-label fw-medium" style="font-size:.88rem">
                            Isi Catatan <span class="text-danger">*</span>
                        </label>
                        <textarea
                            id="isi"
                            name="isi"
                            rows="10"
                            class="form-control @error('isi') is-invalid @enderror"
                            placeholder="Tulis isi catatanmu di sini..."
                        >{{ old('isi', $note->isi) }}</textarea>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4 fw-semibold text-dark">
                            <i class="bi bi-check-lg me-1"></i> Update Catatan
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
