@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('activities.show', $activity) }}" style="color: #64748b; font-size: 0.9rem;">&larr; Kembali ke Detail Kegiatan</a>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-top: 0.5rem;">Ubah Kegiatan: {{ $activity->title }}</h1>
        <p style="color: #475569; font-size: 0.9rem;">Status kegiatan tidak dapat diubah di sini, melainkan melalui transisi status terarah pada halaman detail.</p>
    </div>

    <div class="card">
        <form action="{{ route('activities.update', $activity) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('activities._form', ['activity' => $activity])

            <div style="margin-top: 1.75rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                <a href="{{ route('activities.show', $activity) }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Perbarui Kegiatan</button>
            </div>
        </form>
    </div>
</div>
@endsection