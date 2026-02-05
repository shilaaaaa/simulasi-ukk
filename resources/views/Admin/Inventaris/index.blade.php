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
        width: 220px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .search-box button {
        padding: 8px 14px;
        border: none;
        background: #2563eb;
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

    .btn-add {
        background: #6624d8;
        color: #fff;
        padding: 10px 16px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
    }

    th {
        background: #f3f4f6;
        text-align: left;
        padding: 12px;
        font-size: 14px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    td img {
        width: 80px;
        border-radius: 6px;
        object-fit: cover;
    }

    .action {
        display: flex;
        gap: 8px;
    }

    .btn-edit {
        background: #f59e0b;
        color: #fff;
        padding: 6px 12px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-delete {
        background: #dc2626;
        color: #fff;
        border: none;
        padding: 6px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    }

    .empty {
        text-align: center;
        padding: 30px;
        color: #888;
    }
</style>

<div>
    <div class="page-title">Data Inventaris</div>

    <div class="top-bar">
        <form action="{{ route('inventaris.index') }}" method="GET" class="search-box">
            <input type="text"
                   name="search"
                   placeholder="Cari nama barang..."
                   value="{{ $keyword ?? '' }}">
            <button type="submit">Cari</button>

            @if(!empty($keyword))
                <a href="{{ route('inventaris.index') }}">Reset</a>
            @endif
        </form>

        <a href="/admin/inventaris/create" class="btn-add">+ Tambah Inventaris</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kondisi</th>
                <th>Stok</th>
                <th>Tanggal Register</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($inventaris as $item)
                <tr>
                    <td>{{ $item->id_unique }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ ucfirst($item->kondisi) }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->tgl_register }}</td>
                    <td>
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}">
                        @else
                            -
                        @endif
                    </td>
                    <td class="action">
                        <a href="{{ route('inventaris.edit', $item->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">
                        Data inventaris belum tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
