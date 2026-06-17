<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // ─── Dashboard / Index ────────────────────────────────────────────────────

    public function index()
    {
        $notes = Auth::user()
            ->notes()
            ->latest()
            ->get();

        return view('notes.index', compact('notes'));
    }

    // ─── Tambah Catatan ───────────────────────────────────────────────────────

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi'   => ['required', 'string'],
        ], [
            'judul.required' => 'Judul catatan wajib diisi.',
            'isi.required'   => 'Isi catatan wajib diisi.',
        ]);

        Auth::user()->notes()->create($validated);

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil ditambahkan!');
    }


    public function show(Note $note)
    {
    abort_if($note->user_id !== Auth::id(), 403);

    return view('notes.show', compact('note'));
    }


    // ─── Edit Catatan ─────────────────────────────────────────────────────────

    public function edit(Note $note)
    {
        // Pastikan hanya pemilik yang bisa edit
        abort_if($note->user_id !== Auth::id(), 403);

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi'   => ['required', 'string'],
        ], [
            'judul.required' => 'Judul catatan wajib diisi.',
            'isi.required'   => 'Isi catatan wajib diisi.',
        ]);

        $note->update($validated);

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil diperbarui!');
    }

    // ─── Hapus Catatan ────────────────────────────────────────────────────────

    public function destroy(Note $note)
    {
        abort_if($note->user_id !== Auth::id(), 403);

        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil dihapus!');
    }
}
