@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

{{-- Navbar --}}
<nav class="mynotes-navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            {{-- Brand --}}
            <a href="{{ route('dashboard') }}" class="mynotes-brand">
                <div class="brand-icon">
                    <i class="bi bi-journal-bookmark-fill"></i>
                </div>
                MyNotes
            </a>

            {{-- User & Logout --}}
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

{{-- Main Content --}}
<div class="container py-4">

    {{-- Flash Messages --}}
    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Page Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="font-size:1.3rem">Catatan Saya</h2>
            <p class="text-muted mb-0" style="font-size:.85rem">
                <i class="bi bi-journals me-1"></i>
                {{ $notes->count() }} catatan tersimpan
            </p>
        </div>
        <a href="{{ route('notes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Catatan</span>
        </a>
    </div>

    {{-- Table Card --}}
    <div class="card-mynotes">
        @if ($notes->isEmpty())
        {{-- Empty State --}}
        <div class="empty-state">
            <div class="empty-icon">
                <i class="bi bi-journal-plus"></i>
            </div>
            <h5 class="fw-semibold mb-2">Belum ada catatan</h5>
            <p class="text-muted mb-4" style="font-size:.9rem;max-width:300px;margin-inline:auto">
                Mulai buat catatan pertamamu. Simpan ide, tugas kuliah, atau apapun yang ingin kamu catat.
            </p>
            <a href="{{ route('notes.create') }}" class="btn btn-primary px-4">
                <i class="bi bi-plus-lg me-1"></i> Buat Catatan Pertama
            </a>
        </div>
        @else
        {{-- Notes Table --}}
        <div class="table-responsive">
            <table class="table table-mynotes mb-0">
                <thead>
                    <tr>
                        <th style="width:50px">No</th>
                        <th>Judul</th>
                        <th class="d-none d-md-table-cell">Isi Singkat</th>
                        <th class="d-none d-sm-table-cell" style="width:160px">Tanggal Dibuat</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $index => $note)
                    <tr>
                        <td class="text-muted fw-medium">{{ $index + 1 }}</td>
                        <td>
                            <div class="fw-semibold" style="font-size:.92rem">{{ $note->judul }}</div>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <div class="note-preview">{{ $note->isi }}</div>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <span class="badge-date">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $note->created_at->format('d M Y') }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">


                                {{-- Detail --}}
                                <a
                                    href="{{ route('notes.show', $note) }}"
                                    class="btn btn-outline-success btn-sm"
                                    title="Lihat Catatan"
                                    style="padding:.3rem .6rem;font-size:.8rem">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                {{-- Edit --}}
                                <a
                                    href="{{ route('notes.edit', $note) }}"
                                    class="btn btn-outline-primary btn-sm"
                                    title="Edit Catatan"
                                    style="padding:.3rem .6rem;font-size:.8rem">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>

                                {{-- Hapus --}}
                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm"
                                    title="Hapus Catatan"
                                    style="padding:.3rem .6rem;font-size:.8rem"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapus"
                                    data-id="{{ $note->id }}"
                                    data-judul="{{ $note->judul }}">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="mynotes-footer">
        MyNotes &copy; {{ date('Y') }} &mdash; Tugas Kuliah Pengembangan Aplikasi Berbasis Web
    </div>
</div>

{{-- Modal Hapus --}}
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:420px">
        <div class="modal-content" style="border-radius:12px;border:none;box-shadow:0 8px 32px rgba(0,0,0,.15)">
            <div class="modal-body p-4 text-center">
                <div style="width:60px;height:60px;background:#fef2f2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;color:#dc3545">
                    <i class="bi bi-trash3-fill"></i>
                </div>
                <h5 class="fw-bold mb-2">Hapus Catatan?</h5>
                <p class="text-muted mb-0" style="font-size:.9rem">
                    Apakah Anda yakin ingin menghapus catatan
                    <strong id="modalJudul" class="text-dark">"..."</strong>?
                    <br><span class="text-danger" style="font-size:.82rem">Tindakan ini tidak dapat dibatalkan.</span>
                </p>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2 justify-content-center">
                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                    Batal
                </button>
                <form id="formHapus" action="" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-semibold">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const modalHapus = document.getElementById('modalHapus');
    modalHapus.addEventListener('show.bs.modal', function(event) {
        const btn = event.relatedTarget;
        const id = btn.dataset.id;
        const judul = btn.dataset.judul;

        document.getElementById('modalJudul').textContent = '"' + judul + '"';
        document.getElementById('formHapus').action = '/notes/' + id;
    });
</script>
@endpush