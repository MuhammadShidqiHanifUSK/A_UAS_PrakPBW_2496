<x-layouts::app title="Daftar Santri">
<link rel="stylesheet" href="{{ asset('css/hafalan.css') }}">

<div class="hafalan-wrap">
    <div class="hafalan-header">
        <div class="hafalan-title-wrap">
            <div class="hafalan-icon">👥</div>
            <div>
                <h1 class="hafalan-title">Daftar Santri</h1>
                <p class="hafalan-subtitle">Pilih santri untuk lihat riwayat setoran</p>
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
                    <th>Nama Santri</th>
                    <th>Total Setoran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($santris as $santri)
                    <tr>
                        <td class="no-cell">{{ $loop->iteration }}</td>
                        <td class="santri-name">{{ $santri->name }}</td>
                        <td style="color: #374151;">
                            <span style="background: #f0fdf4; color: #16a34a; padding: 0.2rem 0.75rem; border-radius: 999px; font-size: 0.8rem; font-weight: 600;">
                                {{ $santri->setoran_count }} setoran
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('setoran.riwayat-santri', $santri->id) }}" class="btn-detail">Lihat Riwayat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-icon">👤</div>
                                <p>Belum ada santri. Tambahkan santri melalui halaman <strong>Manajemen User</strong>.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 1rem;">
        {{ $santris->links() }}
    </div>
</div>
</x-layouts::app>