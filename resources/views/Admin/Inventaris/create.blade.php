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

    .note {
        font-size: 13px;
        color: #666;
        margin-top: 4px;
    }
</style>

<div>
    <div class="page-title">➕ Tambah Data Inventaris</div>

    <a href="/admin/inventaris" class="btn-back">← Kembali</a>

    <div class="card">
        <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required>
            </div>

            <div class="form-group">
                <label>Kondisi</label>
                <select name="kondisi" required>
                    <option value="">-- pilih kondisi --</option>
                    <option value="baik">Baik</option>
                    <option value="perbaikan">Perbaikan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" min="0" required>
            </div>

            <div class="form-group">
                <label>Tanggal Register</label>
                <input type="date" name="tgl_register" required>
            </div>

            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
                <div class="note">Format jpg / png, max 2MB</div>
            </div>

            <button type="submit" class="btn btn-primary">💾 Simpan</button>
        </form>
    </div>
</div>
@endsection
