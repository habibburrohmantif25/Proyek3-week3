<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Manager | Modul 3 Special Challenge</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.5;
        }

        a {
            color: #2563eb;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        header {
            background-color: #0f172a;
            color: #ffffff;
            padding: 0.75rem 0;
        }

        .navbar {
            max-width: 1140px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .nav-brand {
            font-weight: 700;
            font-size: 1.1rem;
            color: #ffffff;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .nav-link {
            color: #cbd5e1;
            font-size: 0.9rem;
            padding: 0.4rem 0.75rem;
            border-radius: 4px;
        }

        .nav-link:hover, .nav-link.active {
            color: #ffffff;
            background-color: #1e293b;
            text-decoration: none;
        }

        .container {
            max-width: 1140px;
            margin: 1.5rem auto 3rem;
            padding: 0 1rem;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .btn {
            display: inline-block;
            padding: 0.4rem 0.85rem;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 4px;
            border: 1px solid transparent;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .btn:hover {
            text-decoration: none;
        }

        .btn-primary {
            background-color: #2563eb;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #334155;
            border-color: #cbd5e1;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
        }

        .btn-danger {
            background-color: #dc2626;
            color: #ffffff;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .badge {
            display: inline-block;
            padding: 0.2rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-draft {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .badge-published {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .badge-completed {
            background-color: #e0e7ff;
            color: #3730a3;
            border: 1px solid #c7d2fe;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        th, td {
            padding: 0.65rem 0.85rem;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
        }

        tr:hover td {
            background-color: #fbfcfe;
        }

        input, select, textarea {
            font-family: inherit;
        }

        svg {
            width: 1rem !important;
            height: 1rem !important;
            max-width: 100%;
            vertical-align: middle;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 1rem 0 0;
            gap: 4px;
            flex-wrap: wrap;
            align-items: center;
        }

        .page-item .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            color: #334155;
            background: #ffffff;
            font-size: 0.85rem;
            text-decoration: none;
        }

        .page-item.active .page-link {
            background-color: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
        }

        .page-item.disabled .page-link {
            color: #94a3b8;
            background-color: #f8fafc;
            pointer-events: none;
        }
        .d-flex {
            display: flex;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .align-items-center {
            align-items: center;
        }

        .text-muted {
            color: #64748b;
        }

        .small {
            font-size: 0.85rem;
        }

        .fw-semibold {
            font-weight: 600;
        }

        @media (max-width: 575.98px) {
            .d-none {
                display: none !important;
            }
        }

        @media (min-width: 576px) {
            .d-sm-none {
                display: none !important;
            }

            .d-sm-flex {
                display: flex !important;
            }

            .justify-content-sm-between {
                justify-content: space-between;
            }

            .align-items-sm-center {
                align-items: center;
            }
        }

        footer {
            margin-top: auto;
            border-top: 1px solid #e2e8f0;
            padding: 1rem;
            text-align: center;
            font-size: 0.85rem;
            color: #64748b;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar" aria-label="Navigasi Utama">
            <a href="{{ route('activities.index') }}" class="nav-brand">Activity Manager</a>
            <div class="nav-links">
                <a href="{{ route('activities.index') }}" class="nav-link {{ request()->routeIs('activities.index') ? 'active' : '' }}">Daftar Kegiatan</a>
                <a href="{{ route('activities.trash') }}" class="nav-link {{ request()->routeIs('activities.trash') ? 'active' : '' }}">Tempat Sampah</a>
                <a href="{{ route('activities.create') }}" class="btn btn-primary" style="min-height: 38px; padding: 0.4rem 0.875rem; font-size: 0.875rem;">+ Kegiatan Baru</a>
            </div>
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-left: 1.25rem; margin-top: 0.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>Proyek 3 Modul 3 Special Challenge &bull; D3 Teknik Informatika</p>
    </footer>
</body>
</html>