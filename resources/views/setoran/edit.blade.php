<x-layouts::app title="Edit Setoran">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">✏️</div>
            <div>
                <h1 class="hafalan-title">Edit Setoran</h1>
                <p class="hafalan-subtitle">{{ $setoran->user->name }} — {{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</p>
            </div>
        </div>
        <a href="{{ route('setoran.index') }}" class="btn-kembali">← Kembali</a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <strong>Terdapat kesalahan input:</strong>
            <ul style="margin: 0.5rem 0 0 1rem; padding: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('setoran.update', $setoran->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Tanggal --}}
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">👤 Informasi Setoran</h2>
            <div class="form-group">
                <label class="form-label">Tanggal Setoran</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $setoran->tanggal) }}"
                    class="form-input" style="color-scheme: light; max-width: 300px;">
                @error('tanggal') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Sabaq --}}
        @php $sabaq = $setoran->sabaq->first(); @endphp
        <div class="hafalan-card">
            <h2 class="hafalan-card-title">📗 Sabaq (Hafalan Baru)</h2>
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Surah</label>
                    <select name="sabaq_surah_id" id="select-sabaq-surah">
                        <option value="">-- Cari Surah --</option>
                        @foreach($surahs as $surah)
                            <option value="{{ $surah->id }}" {{ old('sabaq_surah_id', $sabaq?->surah_id) == $surah->id ? 'selected' : '' }}>
                                {{ $surah->nomor }}. {{ $surah->nama_latin }}
                            </option>
                        @endforeach
                    </select>
                    @error('sabaq_surah_id') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai</label>
                    <select name="sabaq_nilai" class="form-select">
                        <option value="">-- Pilih Nilai --</option>
                        <option value="L" {{ old('sabaq_nilai', $sabaq?->nilai) == 'L' ? 'selected' : '' }}>L — Lancar</option>
                        <option value="KL" {{ old('sabaq_nilai', $sabaq?->nilai) == 'KL' ? 'selected' : '' }}>KL — Kurang Lancar</option>
                        <option value="U" {{ old('sabaq_nilai', $sabaq?->nilai) == 'U' ? 'selected' : '' }}>U — Harus Diulang</option>
                    </select>
                    @error('sabaq_nilai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Mulai</label>
                    <input type="number" name="sabaq_ayat_mulai" value="{{ old('sabaq_ayat_mulai', $sabaq?->ayat_mulai) }}"
                        min="1" placeholder="contoh: 1" class="form-input">
                    @error('sabaq_ayat_mulai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Ayat Selesai</label>
                    <input type="number" name="sabaq_ayat_selesai" value="{{ old('sabaq_ayat_selesai', $sabaq?->ayat_selesai) }}"
                        min="1" placeholder="contoh: 10" class="form-input">
                    @error('sabaq_ayat_selesai') <p class="form-error">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Baris</label>
                    <input type="number" name="sabaq_jumlah_baris" value="{{ old('sabaq_jumlah_baris', $sabaq?->jumlah_baris) }}"
                        min="1" placeholder="contoh: 8" class="form-input">
                    @error('sabaq_jumlah_baris') <p class="form-error">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="btn-submit">💾 Update Setoran</button>
        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
    new TomSelect('#select-sabaq-surah', { maxOptions: 114, allowEmptyOption: false, placeholder: 'Ketik nama atau nomor surah...' });
</script>
</x-layouts::app>