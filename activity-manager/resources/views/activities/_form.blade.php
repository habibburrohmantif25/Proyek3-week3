<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem;">
    <div>
        <label for="code" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Kode Kegiatan <span style="color: #dc2626;">*</span>
        </label>
        <input type="text" id="code" name="code" value="{{ old('code', $activity->code ?? '') }}" placeholder="Contoh: ACT-001" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
        @error('code')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category_id" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Kategori <span style="color: #dc2626;">*</span>
        </label>
        <select id="category_id" name="category_id" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px; background: #fff;" required>
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $activity->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>
</div>

<div style="margin-top: 1.25rem;">
    <label for="title" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
        Judul Kegiatan <span style="color: #dc2626;">*</span>
    </label>
    <input type="text" id="title" name="title" value="{{ old('title', $activity->title ?? '') }}" placeholder="Masukkan nama/judul lengkap kegiatan" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
    @error('title')
        <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
    @enderror
</div>

<div style="margin-top: 1.25rem;">
    <label for="description" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
        Deskripsi Kegiatan
    </label>
    <textarea id="description" name="description" rows="4" placeholder="Penjelasan ringkas tentang kegiatan" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
    @enderror
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-top: 1.25rem;">
    <div>
        <label for="start_at" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Waktu Mulai <span style="color: #dc2626;">*</span>
        </label>
        <input type="datetime-local" id="start_at" name="start_at"
            value="{{ old('start_at', isset($activity) && $activity->start_at ? $activity->start_at->format('Y-m-d\TH:i') : '') }}"
            style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
        @error('start_at')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="end_at" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Waktu Selesai <span style="color: #dc2626;">*</span>
        </label>
        <input type="datetime-local" id="end_at" name="end_at"
            value="{{ old('end_at', isset($activity) && $activity->end_at ? $activity->end_at->format('Y-m-d\TH:i') : '') }}"
            style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
        @error('end_at')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; margin-top: 1.25rem;">
    <div>
        <label for="location" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Lokasi Kegiatan <span style="color: #dc2626;">*</span>
        </label>
        <input type="text" id="location" name="location" value="{{ old('location', $activity->location ?? '') }}" placeholder="Contoh: Lab Komputer 1 / Auditorium" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
        @error('location')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="capacity" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
            Kapasitas Peserta (1 - 500) <span style="color: #dc2626;">*</span>
        </label>
        <input type="number" id="capacity" name="capacity" min="1" max="500" value="{{ old('capacity', $activity->capacity ?? 50) }}" style="width: 100%; padding: 0.6rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px;" required>
        @error('capacity')
            <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
        @enderror
    </div>
</div>

<div style="margin-top: 1.25rem;">
    <label for="poster" style="display: block; font-weight: 600; font-size: 0.9rem; margin-bottom: 0.35rem; color: #1e293b;">
        Poster Kegiatan (Opsional, format gambar maks 2 MB)
    </label>
    <input type="file" id="poster" name="poster" accept="image/jpeg,image/png,image/jpg,image/webp" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; min-height: 44px; background: #fff;">
    @error('poster')
        <p style="color: #dc2626; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</p>
    @enderror

    @if (isset($activity) && $activity->poster_path)
        <div style="margin-top: 0.75rem; display: flex; align-items: center; gap: 1rem;">
            <img src="{{ asset('storage/' . $activity->poster_path) }}" alt="Poster saat ini" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
            <span style="font-size: 0.85rem; color: #64748b;">Poster saat ini telah diunggah. Pilih file baru jika ingin mengganti poster.</span>
        </div>
    @endif
</div>