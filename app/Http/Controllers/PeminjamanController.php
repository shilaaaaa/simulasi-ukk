<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Inventaris;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $peminjaman = Peminjaman::with('inventaris')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_peminjam', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhereHas('inventaris', function ($q) use ($search) {
                        $q->where('nama_barang', 'like', "%{$search}%")
                            ->orWhere('id_unique', 'like', "%{$search}%");
                    });
            })
            ->get();

        return view('Peminjaman.index', compact('peminjaman', 'search'));
    }


    public function create()
    {
        $inventaris = Inventaris::all();
        return view('Peminjaman.create', compact('inventaris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_inventaris' => 'required|exists:inventaris,id',
            'nama_peminjam' => 'required|string|max:100',
            'tgl_pinjam'    => 'required|date',
            'tgl_kembali'   => 'required|date|after_or_equal:tgl_pinjam',
            'petugas'       => 'required|string|max:100',
            'status'        => 'required|in:proses,belum kembali,kembali',
        ]);

        $inventaris = Inventaris::findOrFail($request->id_inventaris);

        // jika langsung dipinjam
        if ($request->status === 'belum kembali') {
            if ($inventaris->stok < 1) {
                return back()->withErrors([
                    'stok' => 'Stok barang habis'
                ]);
            }

            $inventaris->decrement('stok', 1);
        }

        Peminjaman::create([
            'id_inventaris' => $request->id_inventaris,
            'nama_peminjam' => $request->nama_peminjam,
            'tgl_pinjam'    => $request->tgl_pinjam,
            'tgl_kembali'   => $request->tgl_kembali,
            'petugas'       => $request->petugas,
            'status'        => $request->status,
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibuat');
    }

    public function edit($id)
    {
        $item = Peminjaman::findOrFail($id);
        $inventaris = Inventaris::all();

        return view('Peminjaman.edit', compact('item', 'inventaris'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $request->validate([
            'id_inventaris' => 'required|exists:inventaris,id',
            'nama_peminjam' => 'required|string|max:100',
            'tgl_pinjam'    => 'required|date',
            'tgl_kembali'   => 'required|date|after_or_equal:tgl_pinjam',
            'petugas'       => 'required|string|max:100',
            'status'        => 'required|in:proses,belum kembali,kembali',
        ]);

        $inventaris = Inventaris::findOrFail($request->id_inventaris);

        if ($peminjaman->status !== 'belum kembali' && $request->status === 'belum kembali') {
            // mau pinjam
            if ($inventaris->stok < 1) {
                return back()->withErrors([
                    'stok' => 'Stok barang habis'
                ]);
            }
            $inventaris->decrement('stok', 1);
        }

        if ($peminjaman->status === 'belum kembali' && $request->status === 'kembali') {
            // barang dikembalikan
            $inventaris->increment('stok', 1);
        }

        $peminjaman->update([
            'id_inventaris' => $request->id_inventaris,
            'nama_peminjam' => $request->nama_peminjam,
            'tgl_pinjam'    => $request->tgl_pinjam,
            'tgl_kembali'   => $request->tgl_kembali,
            'petugas'       => $request->petugas,
            'status'        => $request->status,
        ]);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // jika dihapus saat barang belum kembali, stok dibalikin
        if ($peminjaman->status === 'belum kembali') {
            $peminjaman->inventaris->increment('stok', 1);
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus');
    }
}