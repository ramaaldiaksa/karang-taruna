<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamans';
    protected $primaryKey = 'id_detail';
    protected $fillable = ['id_peminjaman', 'id_inventaris', 'jumlah_pinjam', 'kondisi_pinjam', 'kondisi_kembali'];

    public function peminjaman() { return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman'); }
    public function inventaris() { return $this->belongsTo(Inventaris::class, 'id_inventaris', 'id_inventaris'); }
}
