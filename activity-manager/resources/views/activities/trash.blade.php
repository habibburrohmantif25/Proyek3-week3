@extends('layouts.app')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
    <div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #0f172a;">Tempat Sampah Kegiatan (Soft Delete)</h1>
        <p style="color: #475569; font-size: 0.9rem;">Daftar kegiatan yang telah dihapus sementara dan dapat dipulihkan kembali ke daftar aktif.</p>
    </div>
    <div>
        <a href="{{ route('activities.index') }}" class="btn btn-secondary" style="font-size: 0.875rem;">&larr; Kembali ke Daftar Kegiatan</a>
    </div>
</div>

<div class="card" style="padding: 0; overflow-x: auto;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
        <thead style="background-color: #f1f5f9; border-bottom: 1px solid #cbd5e1;">
            <tr>
                <th style="padding: 0.75rem 1rem;">Kode</th>
                <th style="padding: 0.75rem 1rem;">Judul & Kategori</th>
                <th style="padding: 0.75rem 1rem;">Waktu Dihapus</th>
                <th style="padding: 0.75rem 1rem; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($trashedActivities as $activity)
                <tr style="border-bottom: 1px solid #e2e8f0;">
                    <td style="padding: 0.875rem 1rem; font-family: monospace; font-weight: 600; color: #1e293b;">
                        {{ $activity->code }}
                    </td>
                    <td style="padding: 0.875rem 1rem;">
                        <span style="font-weight: 600; color: #334155;">{{ $activity->title }}</span>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">
                            Kategori: {{ $activity->category?->name ?? 'Tanpa Kategori' }}
                        </div>
                    </td>
                    <td style="padding: 0.875rem 1rem; color: #64748b;">
                        {{ $activity->deleted_at ? $activity->deleted_at->format('d M Y, H:i') : '-' }}
                    </td>
                    <td style="padding: 0.875rem 1rem; text-align: right;">
                        <form action="{{ route('activities.restore', $activity->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success" style="min-height: 36px; padding: 0.35rem 0.75rem; font-size: 0.85rem;">
                                Pulihkan Data
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 2.5rem 1rem; text-align: center; color: #64748b;">
                        Tempat sampah kosong. Tidak ada data kegiatan yang sedang terhapus.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 1.25rem;">
    {{ $trashedActivities->links() }}
</div>
@endsection
