@extends('layouts.app')

@section('title', 'Detail Catatan')

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

    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-decoration-none">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <span class="text-muted mx-2">/</span>
        <span class="text-muted">Detail Catatan</span>
    </div>

    <div class="card-mynotes p-4">
        <div class="d-flex align-items-start gap-3 mb-4">
            <div style="width:52px;height:52px;background:#e7f1ff;border-radius:12px;display:flex;align-items:center;justify-content:center;color:#0d6efd;font-size:1.4rem">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-1" style="font-size:1.4rem">{{ $note->judul }}</h3>
                <p class="text-muted mb-0" style="font-size:.9rem">
                    Dibuat: {{ $note->created_at->format('d M Y, H:i') }}
                </p>
            </div>
        </div>

        <hr>

        <div class="mt-4">
            <h6 class="fw-semibold mb-3">Isi Catatan</h6>
            <div class="p-3 bg-light rounded" style="white-space: pre-wrap; line-height:1.7; font-size:.95rem">
                {{ $note->isi }}
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

            <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning fw-semibold">
                <i class="bi bi-pencil-fill me-1"></i> Edit
            </a>
        </div>
    </div>

    <div class="mynotes-footer">
        MyNotes &copy; {{ date('Y') }} &mdash; Tugas Kuliah Pengembangan Aplikasi Berbasis Web
    </div>
</div>

@endsection