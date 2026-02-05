@extends('layouts.sidebar')

@section('content')
<style>
    .page-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .search-box input {
        padding: 8px 10px;
        width: 260px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-box button {
        padding: 8px 14px;
        border: none;
        background: #6624d8; /* UNGU */
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-box a {
        margin-left: 10px;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    th {
        background: #f3f4f6;
        padding: 12px;
        text-align: left;
        font-size: 14px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .proses {
        background: #fde68a;
        color: #92400e;
    }

    .belum {
        background: #fecaca;
        color: #991b1b;
    }

    .kembali {
        background: #bbf7d0;
        color: #166534;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #888;
    }
</style>

<div>
    <div class="page-title">📄 Data Peminjaman</div>

    <div class="top-bar">
        <form action="{{ route('peminjaman.index') }}" method="GET" class="search-box">
            <input type="text"
                   name="search"
                   placeholder="Cari nama peminjam / barang"
                   value="{{ $keyword ?? '' }}">
            <button type="submit">Cari</button>

            @if(!empty($keyword))
                <a href="{{ route('peminjaman.index') }}">Reset</a>
            @endif
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Inventaris</th>
                <th>Barang</th>
                <th>Stok</th>
                <th>Peminjam</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Petugas</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($peminjaman as $p)
                <tr>
                    <td>{{ $p->inventaris->id_unique }}</td>
                    <td>{{ $p->inventaris->nama_barang }}</td>
                    <td>{{ $p->inventaris->stok }}</td>
                    <td>{{ $p->nama_peminjam }}</td>
                    <td>{{ $p->tgl_pinjam }}</td>
                    <td>{{ $p->tgl_kembali }}</td>
                    <td>
                        <span class="badge
                            @if($p->status == 'proses') proses
                            @elseif($p->status == 'belum kembali') belum
                            @else kembali
                            @endif">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td>{{ $p->petugas }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">
                        Data peminjaman belum tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
