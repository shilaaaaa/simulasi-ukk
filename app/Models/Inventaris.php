<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Peminjaman;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $fillable = ['id', 'id_unique', 'nama_barang', 'kondisi', 'stok', 'tgl_register', 'foto'];

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class, 'id_inventaris');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model){
            $last = DB::table('inventaris')->latest('id')->first();

            $number = $last ? intval(substr($last->id_unique, 2)) + 1 : 1;

            $model->id_unique = 'IV' . str_pad($number, 2, '0', STR_PAD_LEFT);
        });
    }
}
