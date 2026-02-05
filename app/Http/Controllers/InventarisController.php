<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
   public function index(Request $request)
{
    $keyword = $request->search;

    $inventaris = Inventaris::when($keyword, function ($query, $keyword) {
        $query->where('nama_barang', 'like', '%' . $keyword . '%');
    })->get();

    return view('Admin.Inventaris.index', compact('inventaris', 'keyword'));
}
    public function create()
    {
        return view('Admin.Inventaris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:250',
            'kondisi' => 'required|string',
            'stok' => 'required|integer',
            'tgl_register' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_barang',
            'kondisi',
            'stok',
            'tgl_register'
        ]);

        // SIMPAN FOTO KE folder foto_inventaris
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto_inventaris', 'public');
        }

        Inventaris::create($data);

        return redirect()->route('inventaris.index')
            ->with('success', 'Data Berhasil Ditambah!');
    }

    public function edit(string $id)
    {
        $item = Inventaris::findOrFail($id);
        return view('Admin.Inventaris.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:250',
            'kondisi' => 'required|string',
            'stok' => 'required|integer',
            'tgl_register' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'nama_barang',
            'kondisi',
            'stok',
            'tgl_register'
        ]);

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($inventaris->foto && Storage::disk('public')->exists($inventaris->foto)) {
                Storage::disk('public')->delete($inventaris->foto);
            }

            // simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('foto_inventaris', 'public');
        }

        $inventaris->update($data);

        return redirect()->route('inventaris.index')
            ->with('success', 'Data Berhasil Diedit!');
    }

    public function destroy(string $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        if ($inventaris->foto && Storage::disk('public')->exists($inventaris->foto)) {
            Storage::disk('public')->delete($inventaris->foto);
        }

        $inventaris->delete();

        return redirect()->route('inventaris.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }
}