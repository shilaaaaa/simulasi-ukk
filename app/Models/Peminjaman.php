<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventaris;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $fillable = ['id_inventaris', 'nama_peminjam', 'tgl_pinjam', 'tgl_kembali', 'status', 'petugas'];

    public function inventaris(){
        return $this->belongsTo(Inventaris::class, 'id_inventaris');
    }
}
