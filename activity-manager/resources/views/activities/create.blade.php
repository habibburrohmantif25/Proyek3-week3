@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('activities.index') }}" style="color: #64748b; font-size: 0.9rem;">&larr; Kembali ke Daftar Kegiatan</a>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: #0f172a; margin-top: 0.5rem;">Tambah Kegiatan Baru</h1>
        <p style="color: #475569; font-size: 0.9rem;">Data kegiatan baru akan otomatis berstatus <strong>Draft</strong> sebelum dipublikasikan.</p>
    </div>

    <div class="card">
        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('activities._form')

            <div style="margin-top: 1.75rem; display: flex; gap: 0.75rem; justify-content: flex-end;">
                <a href="{{ route('activities.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan sebagai Draft</button>
            </div>
        </form>
    </div>
</div>
@endsection