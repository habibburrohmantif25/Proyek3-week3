@extends('layouts.app')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="margin-bottom: 1.25rem;">
        <a href="{{ route('activities.index') }}" style="color: #64748b; font-size: 0.9rem;">&larr; Kembali ke Daftar Kegiatan</a>
    </div>

    <article class="card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.25rem;">
            <div>
                <span style="font-family: monospace; font-size: 0.9rem; font-weight: 700; color: #475569; background: #e2e8f0; padding: 0.2rem 0.5rem; border-radius: 4px;">
                    {{ $activity->code }}
                </span>
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #0f172a; margin-top: 0.5rem;">
                    {{ $activity->title }}
                </h1>
                <p style="color: #64748b; font-size: 0.95rem; margin-top: 0.25rem;">
                    Kategori: <strong>{{ $activity->category?->name ?? 'Tanpa Kategori' }}</strong>
                </p>
            </div>
            <div>
                <span class="badge badge-{{ $activity->status }}" style="font-size: 0.95rem; padding: 0.4rem 0.8rem;">
                    {{ $activity->status }}
                </span>
            </div>
        </div>

        @if ($activity->poster_path)
            <div style="margin-bottom: 1.5rem;">
                <img src="{{ asset('storage/' . $activity->poster_path) }}" alt="Poster {{ $activity->title }}" style="max-width: 100%; max-height: 400px; object-fit: contain; border-radius: 8px; border: 1px solid #cbd5e1; background: #f1f5f9;">
            </div>
        @endif

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; background: #f8fafc; padding: 1rem; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem;">
            <div>
                <span style="font-size: 0.8rem; color: #64748b; display: block; text-transform: uppercase; font-weight: 600;">Waktu Pelaksanaan</span>
                <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">
                    {{ $activity->start_at ? $activity->start_at->format('d M Y, H:i') : '-' }} s/d {{ $activity->end_at ? $activity->end_at->format('d M Y, H:i') : '-' }}
                </span>
            </div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; display: block; text-transform: uppercase; font-weight: 600;">Lokasi</span>
                <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">
                    {{ $activity->location }}
                </span>
            </div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; display: block; text-transform: uppercase; font-weight: 600;">Kuota Peserta</span>
                <span style="font-weight: 600; color: #1e293b; font-size: 0.95rem;">
                    <strong>{{ $activity->registered_count }}</strong> / {{ $activity->capacity }} Terdaftar
                </span>
            </div>
        </div>

        <div style="margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 0.5rem; color: #0f172a;">Deskripsi</h2>
            <p style="color: #334155; white-space: pre-line; line-height: 1.6;">
                {{ $activity->description ?: 'Tidak ada deskripsi kegiatan yang dicantumkan.' }}
            </p>
        </div>

        <div style="background-color: #f1f5f9; padding: 1.25rem; border-radius: 6px; border: 1px solid #cbd5e1; margin-bottom: 1.5rem;">
            <h3 style="font-size: 0.95rem; font-weight: 700; color: #1e293b; margin-bottom: 0.5rem;">Transisi Siklus Status (Business Rule)</h3>
            <p style="font-size: 0.85rem; color: #475569; margin-bottom: 1rem;">
                Perubahan status dilakukan secara eksplisit melalui aturan domain (Draft &rarr; Published &rarr; Completed).
            </p>

            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
                @if ($activity->isDraft())
                    <form action="{{ route('activities.publish', $activity) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Publikasikan Kegiatan (Publish)</button>
                    </form>
                @elseif ($activity->isPublished())
                    <form action="{{ route('activities.complete', $activity) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Tandai Selesai (Complete)</button>
                    </form>
                @elseif ($activity->isCompleted())
                    <span style="color: #065f46; font-weight: 600; font-size: 0.9rem;">
                        Kegiatan telah selesai. Transisi status telah final (BR-07).
                    </span>
                @endif
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #e2e8f0; padding-top: 1.25rem; flex-wrap: wrap; gap: 0.75rem;">
            <div>
                <a href="{{ route('activities.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('activities.edit', $activity) }}" class="btn btn-secondary">Edit Data</a>
            </div>

            <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Pindahkan kegiatan ini ke tempat sampah (soft delete)?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus ke Tempat Sampah</button>
            </form>
        </div>
    </article>

    <section class="card" aria-label="Pendaftaran Peserta">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 0.5rem;">
            Pendaftaran Peserta (Atomic Transaction)
        </h2>
        <p style="color: #475569; font-size: 0.9rem; margin-bottom: 1.25rem;">
            Pendaftaran memproses pencatatan peserta dan penambahan kuota <code>registered_count</code> secara atomic menggunakan <code>DB::transaction</code>.
        </p>

        @if ($activity->isPublished() && now()->lessThan($activity->start_at) && $activity->registered_count < $activity->capacity)
            <form action="{{ route('activities.register', $activity) }}" method="POST" style="background: #f8fafc; padding: 1.25rem; border-radius: 6px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem;">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem;">
                    <div>
                        <label for="participant_name" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem;">Nama Lengkap Peserta</label>
                        <input type="text" id="participant_name" name="participant_name" value="{{ old('participant_name') }}" placeholder="Contoh: Budi Santoso" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; min-height: 44px;" required>
                    </div>

                    <div>
                        <label for="email" style="display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem;">Email Peserta</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Contoh: budi@example.com" style="width: 100%; padding: 0.5rem; border: 1px solid #cbd5e1; border-radius: 6px; min-height: 44px;" required>
                    </div>
                </div>

                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn btn-primary">Daftar Kegiatan Sekarang</button>
                </div>
            </form>
        @else
            <div style="background-color: #f1f5f9; padding: 1rem; border-radius: 6px; border: 1px solid #cbd5e1; margin-bottom: 1.5rem; color: #475569; font-size: 0.9rem;">
                @if (!$activity->isPublished())
                    Pendaftaran belum dibuka karena kegiatan belum berstatus <strong>Published</strong> (status saat ini: {{ $activity->status }}).
                @elseif (now()->greaterThanOrEqualTo($activity->start_at))
                    Pendaftaran ditutup karena kegiatan telah dimulai atau telah lewat jadwalnya.
                @elseif ($activity->registered_count >= $activity->capacity)
                    Pendaftaran ditutup karena kuota kapasitas kegiatan telah penuh.
                @endif
            </div>
        @endif

        <h3 style="font-size: 1rem; font-weight: 700; color: #1e293b; margin-bottom: 0.75rem;">Daftar Peserta Terdaftar ({{ $activity->registrations->count() }})</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.9rem; text-align: left;">
                <thead style="background: #f1f5f9; border-bottom: 1px solid #cbd5e1;">
                    <tr>
                        <th style="padding: 0.5rem 0.75rem;">No</th>
                        <th style="padding: 0.5rem 0.75rem;">Nama Peserta</th>
                        <th style="padding: 0.5rem 0.75rem;">Email</th>
                        <th style="padding: 0.5rem 0.75rem;">Waktu Registrasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activity->registrations as $index => $reg)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 0.6rem 0.75rem;">{{ $index + 1 }}</td>
                            <td style="padding: 0.6rem 0.75rem; font-weight: 600;">{{ $reg->participant_name }}</td>
                            <td style="padding: 0.6rem 0.75rem; color: #475569;">{{ $reg->email }}</td>
                            <td style="padding: 0.6rem 0.75rem; color: #64748b;">{{ $reg->registered_at ? $reg->registered_at->format('d M Y, H:i:s') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 1.5rem 0.75rem; text-align: center; color: #64748b;">
                                Belum ada peserta yang mendaftar pada kegiatan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection