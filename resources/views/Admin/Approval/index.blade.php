<h1>Data Peminjaman (Approval)</h1>

<table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <th>ID Inventaris</th>
        <th>Barang</th>
        <th>Peminjam</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
        <th>Petugas</th>
        <th>Aksi</th>
    </tr>

    @foreach ($peminjaman as $p)
    <tr>
        <td>{{ $p->inventaris->id_unique }}</td>
        <td>{{ $p->inventaris->nama_barang }}</td>
        <td>{{ $p->nama_peminjam }}</td>
        <td>{{ $p->tgl_pinjam }}</td>
        <td>{{ $p->tgl_kembali }}</td>
        <td>{{ ucfirst($p->status) }}</td>
        <td>{{ $p->petugas }}</td>
        <td>
            @if ($p->status == 'menunggu')
                <form action="{{ route('approval.update', $p->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <select name="status" required>
                        <option value="">-- pilih --</option>
                        <option value="disetujui">Setujui</option>
                        <option value="ditolak">Tolak</option>
                    </select>

                    <button type="submit">OK</button>
                </form>
            @else
                <em>-</em>
            @endif
        </td>
    </tr>
    @endforeach
</table>