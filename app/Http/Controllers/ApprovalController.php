<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Inventaris;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with('inventaris')->get();
        return view('Admin.Approval.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Peminjaman::findOrFail($id);
        $inventaris = Inventaris::all();

        return view('Peminjaman.edit', compact('item', 'inventaris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $request->validate([
        'status' => 'required|in:disetujui,ditolak'
    ]);

    $peminjaman = Peminjaman::findOrFail($id);

    // hanya admin yg boleh update status
    $peminjaman->update([
        'status' => $request->status
    ]);

    return redirect()
        ->route('approval.index')
        ->with('success', 'Status berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
