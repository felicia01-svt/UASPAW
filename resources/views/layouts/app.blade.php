<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MyNotes') — Catatan Pribadimu</title>

    {{-- Bootstrap 5.3 CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ── Base ─────────────────────────────────────────── */
        :root {
            --primary:       #0d6efd;
            --primary-hover: #0b5ed7;
            --primary-light: #e8f0fe;
            --surface:       #ffffff;
            --bg:            #f0f4f8;
            --border:        #dee2e6;
            --text:          #212529;
            --text-muted:    #6c757d;
            --success:       #198754;
            --danger:        #dc3545;
            --shadow-sm:     0 1px 3px rgba(0,0,0,.08);
            --shadow-md:     0 4px 16px rgba(0,0,0,.10);
            --radius:        12px;
            --radius-sm:     8px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Navbar ───────────────────────────────────────── */
        .mynotes-navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            padding: .75rem 0;
        }

        .mynotes-brand {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary) !important;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: .45rem;
            letter-spacing: -.5px;
        }

        .mynotes-brand .brand-icon {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1rem;
        }

        .user-badge {
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            padding: .3rem .85rem;
            font-size: .82rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: .35rem;
        }

        /* ── Cards ────────────────────────────────────────── */
        .card-mynotes {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s;
        }

        .card-mynotes:hover { box-shadow: var(--shadow-md); }

        /* ── Buttons ──────────────────────────────────────── */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 500;
            border-radius: var(--radius-sm);
        }
        .btn-primary:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        .btn-outline-primary { border-radius: var(--radius-sm); font-weight: 500; }
        .btn-outline-danger   { border-radius: var(--radius-sm); font-weight: 500; }

        /* ── Form Controls ────────────────────────────────── */
        .form-control, .form-select {
            border-radius: var(--radius-sm);
            border-color: var(--border);
            padding: .6rem .9rem;
            font-size: .92rem;
            transition: border-color .15s, box-shadow .15s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
        }

        /* ── Table ────────────────────────────────────────── */
        .table-mynotes thead th {
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            font-size: .8rem;
            text-transform: uppercase;
            letter-spacing: .5px;
            border-bottom: 2px solid #c7d9fd;
            padding: .85rem 1rem;
        }
        .table-mynotes tbody td {
            vertical-align: middle;
            padding: .85rem 1rem;
            border-bottom: 1px solid #f0f2f5;
            font-size: .9rem;
        }
        .table-mynotes tbody tr:last-child td { border-bottom: none; }
        .table-mynotes tbody tr:hover td { background: #fafbff; }

        .note-preview {
            color: var(--text-muted);
            font-size: .84rem;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .badge-date {
            background: #f0f4f8;
            color: var(--text-muted);
            font-size: .75rem;
            font-weight: 500;
            border-radius: 6px;
            padding: .25rem .6rem;
        }

        /* ── Empty State ──────────────────────────────────── */
        .empty-state {
            padding: 4rem 2rem;
            text-align: center;
        }
        .empty-state .empty-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 2rem;
            color: var(--primary);
        }

        /* ── Auth Pages ───────────────────────────────────── */
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #e8f0fe 0%, #f0f4f8 60%, #ffffff 100%);
            padding: 2rem 1rem;
        }

        .auth-card {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
        }

        .auth-header {
            background: var(--primary);
            padding: 2rem 2rem 1.75rem;
            text-align: center;
        }

        .auth-header .brand-icon-lg {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .75rem;
            font-size: 1.5rem;
            color: #fff;
        }

        .auth-header h1 {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 .25rem;
            letter-spacing: -.4px;
        }

        .auth-header p { color: rgba(255,255,255,.75); margin: 0; font-size: .88rem; }

        .auth-body { padding: 2rem; }

        /* ── Alerts ───────────────────────────────────────── */
        .alert {
            border-radius: var(--radius-sm);
            border: none;
            font-size: .9rem;
            padding: .75rem 1rem;
        }
        .alert-success { background: #d1e7dd; color: #0a3622; }
        .alert-danger  { background: #f8d7da; color: #58151c; }

        /* ── Page Header ──────────────────────────────────── */
        .page-header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 1.25rem 0;
            margin-bottom: 1.75rem;
        }
        .page-header h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
            color: var(--text);
        }
        .page-header .breadcrumb { margin: 0; font-size: .82rem; }

        /* ── Footer ───────────────────────────────────────── */
        .mynotes-footer {
            text-align: center;
            padding: 1.5rem 0 2rem;
            color: var(--text-muted);
            font-size: .8rem;
        }

        /* ── Misc ─────────────────────────────────────────── */
        .divider-text {
            position: relative;
            text-align: center;
            margin: 1.25rem 0;
        }
        .divider-text::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0; right: 0;
            height: 1px;
            background: var(--border);
        }
        .divider-text span {
            position: relative;
            background: var(--surface);
            padding: 0 .75rem;
            color: var(--text-muted);
            font-size: .8rem;
        }
    </style>

    @stack('styles')
</head>
<body>

@yield('content')

{{-- Bootstrap 5.3 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
