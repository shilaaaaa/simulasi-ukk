@extends('layouts.sidebar')

@section('content')
<style>
    .page-title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 20px;
    }


    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
    }

    input, select {
        width: 100%;
        padding: 9px 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #7c3aed;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-primary {
        background: #7c3aed; /* UNGU */
        color: #fff;
    }

    .btn-back {
        text-decoration: none;
        color: #555;
        margin-bottom: 15px;
        display: inline-block;
    }

    .photo-preview {
        margin-top: 8px;
    }

    .photo-preview img {
        width: 120px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .note {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }
</style>

<div>
    <div class="page-title">✏️ Edit Data Inventaris</div>

    <a href="/admin/inventaris" class="btn-back">← Kembali</a>

    <div class="card">
        <form action="{{ route('inventaris.update', $item->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       value="{{ old('nama_barang', $item->nama_barang) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="">-- pilih kondisi --</option>
                    <option value="baik"
                        {{ old('kondisi', $item->kondisi) == 'baik' ? 'selected' : '' }}>
                        Baik
                    </option>
                    <option value="perbaikan"
                        {{ old('kondisi', $item->kondisi) == 'perbaikan' ? 'selected' : '' }}>
                        Perbaikan
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number"
                       name="stok"
                       min="0"
                       value="{{ old('stok', $item->stok) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Tanggal Register</label>
                <input type="date"
                       name="tgl_register"
                       value="{{ old('tgl_register', $item->tgl_register) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Foto Lama</label>
                <div class="photo-preview">
                    @if($item->foto)
                        <img src="{{ asset('storage/' . $item->foto) }}">
                    @else
                        <span class="note">Tidak ada foto</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label>Ganti Foto</label>
                <input type="file" name="foto">
                <div class="note">Kosongkan jika tidak ingin mengganti foto</div>
            </div>

            <button type="submit" class="btn btn-primary">💾 Update</button>
        </form>
    </div>
</div>
@endsection
