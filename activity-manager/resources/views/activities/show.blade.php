@extends('layouts.app')

@section('content')
    <article class="card">
        <h1>{{ $activity->title }}</h1>
        <p><strong>Tanggal:</strong> {{ $activity->activity_date->format('d M Y') }}</p>
        <p><strong>Kategori:</strong> {{ $activity->category }}</p>
        <p><strong>Status:</strong> {{ $activity->status }}</p>
        <p><strong>Deskripsi:</strong> {{ $activity->description ?? '-' }}</p>
        <a href="{{ route('activities.index') }}">← Kembali ke Daftar</a>
        <a href="{{ route('activities.edit', $activity) }}">Edit Kegiatan</a>

        <form action="{{ route('activities.destroy', $activity) }}" method="POST"
            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus Kegiatan</button>
        </form>
    </article>
@endsection