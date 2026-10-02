@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #0f172a;">Daftar Kegiatan</h1>
        <p style="color: #475569; font-size: 0.9rem;">Kelola data kegiatan, transisi status, dan kuota pendaftaran.</p>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="{{ route('activities.trash') }}" class="btn btn-secondary" style="font-size: 0.875rem;">Lihat Tempat Sampah</a>
        <a href="{{ route('activities.create') }}" class="btn btn-primary" style="font-size: 0.875rem;">+ Tambah Kegiatan</a>
    </div>
</div>

<section class="card" aria-label="Pencarian dan Filter">
    <form method="GET" action="{{ route('activities.index') }}" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: flex-end;">
        <div>
            <label for="search" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem; color: #334155;">Cari Judul atau Kode</label>
            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Contoh: ACT-001 atau Workshop" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; min-height: 44px;">
        </div>

        <div>
            <label for="category_id" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem; color: #334155;">Kategori</label>
            <select id="category_id" name="category_id" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; min-height: 44px; background: #fff;">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="status" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem; color: #334155;">Status</label>
            <select id="status" name="status" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; min-height: 44px; background: #fff;">
                <option value="">Semua Status</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
                <option value="completed" @selected(request('status') === 'completed')>Completed</option>
            </select>
        </div>

        <div>
            <label for="sort" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem; color: #334155;">Urutan Tanggal</label>
            <select id="sort" name="sort" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem; min-height: 44px; background: #fff;">
                <option value="newest" @selected(request('sort', 'newest') === 'newest')>Tanggal Terbaru</option>
                <option value="oldest" @selected(request('sort') === 'oldest')>Tanggal Terlama</option>
            </select>
        </div>

        <div style="display: flex; gap: 0.5rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">Filter Data</button>
            <a href="{{ route('activities.index') }}" class="btn btn-secondary" title="Hapus Filter">Reset</a>
        </div>
    </form>
</section>

<div class="card" style="padding: 0; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
        <thead style="background-color: #f1f5f9; border-bottom: 1px solid #cbd5e1;">
            <tr>
                <th style="padding: 0.75rem 1rem;">Kode</th>
                <th style="padding: 0.75rem 1rem;">Judul & Kategori</th>
                <th style="padding: 0.75rem 1rem;">Waktu Pelaksanaan</th>
                <th style="padding: 0.75rem 1rem;">Lokasi</th>
                <th style="padding: 0.75rem 1rem;">Peserta / Kapasitas</th>
                <th style="padding: 0.75rem 1rem;">Status</th>
                <th style="padding: 0.75rem 1rem; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($activities as $activity)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 0.875rem 1rem; font-family: monospace; font-weight: 600; color: #1e293b;">
                        {{ $activity->code }}
                    </td>
                    <td style="padding: 0.875rem 1rem;">
                        <a href="{{ route('activities.show', $activity) }}" style="font-weight: 600; color: #1e3a8a;">
                            {{ $activity->title }}
                        </a>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">
                            Kategori: {{ $activity->category?->name ?? 'Tanpa Kategori' }}
                        </div>
                    </td>
                    <td style="padding: 0.875rem 1rem; color: #334155;">
                        {{ $activity->start_at ? $activity->start_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <td style="padding: 0.875rem 1rem; color: #334155;">
                        {{ $activity->location }}
                    </td>
                    <td style="padding: 0.875rem 1rem; color: #334155;">
                        <strong>{{ $activity->registered_count }}</strong> / {{ $activity->capacity }}
                    </td>
                    <td style="padding: 0.875rem 1rem;">
                        <span class="badge badge-{{ $activity->status }}">
                            {{ $activity->status }}
                        </span>
                    </td>
                    <td style="padding: 0.875rem 1rem; text-align: right; white-space: nowrap;">
                        <a href="{{ route('activities.show', $activity) }}" class="btn btn-secondary" style="min-height: 34px; padding: 0.25rem 0.5rem; font-size: 0.8rem;">Detail</a>
                        <a href="{{ route('activities.edit', $activity) }}" class="btn btn-secondary" style="min-height: 34px; padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>
                        <form action="{{ route('activities.destroy', $activity) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Pindahkan kegiatan ini ke tempat sampah (soft delete)?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="min-height: 34px; padding: 0.25rem 0.5rem; font-size: 0.8rem;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="padding: 2.5rem 1rem; text-align: center; color: #64748b;">
                        Tidak ada data kegiatan yang sesuai dengan kriteria filter saat ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.25rem;">
    {{ $activities->links() }}
</div>
@endsection