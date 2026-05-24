<x-layouts::app title="Daftar Setoran">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">📖</div>
            <div>
                <h1 class="hafalan-title">Daftar Setoran</h1>
                <p class="hafalan-subtitle">Monitor Hafalan Al-Quran</p>
            </div>
        </div>
        <a href="{{ route('setoran.create') }}" class="btn-tambah">＋ Tambah Setoran</a>
    </div>

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif

    <div class="table-wrap">
        <table class="setoran-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Santri</th>
                    <th>Tanggal</th>
                    <th>Paraf Guru</th>
                    <th>Paraf Ortu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($setorans as $setoran)
                    <tr>
                        <td class="no-cell">{{ $loop->iteration }}</td>
                        <td class="santri-name">{{ $setoran->user->name }}</td>
                        <td class="tanggal-text">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($setoran->paraf_guru)
                                <span class="badge-sudah">✓ Sudah</span>
                            @else
                                <span class="badge-belum">✗ Belum</span>
                            @endif
                        </td>
                        <td>
                            @if($setoran->paraf_ortu)
                                <span class="badge-sudah">✓ Sudah</span>
                            @else
                                <span class="badge-belum">✗ Belum</span>
                            @endif
                        </td>
                        <td>
                            <div class="aksi-wrap">
                                <a href="{{ route('setoran.show', $setoran->id) }}" class="btn-detail">Detail</a>
                                <a href="{{ route('setoran.edit', $setoran->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('setoran.destroy', $setoran->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus setoran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-hapus">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">📋</div>
                                <p>Belum ada data setoran. Klik <strong>Tambah Setoran</strong> untuk memulai.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1rem;">
        {{ $setorans->links() }}
    </div>
</div>
</x-layouts::app>