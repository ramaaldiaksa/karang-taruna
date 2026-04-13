<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $primaryKey = 'id_pengembalian';
    protected $fillable = ['id_peminjaman', 'id_admin', 'tanggal_kembali', 'keterangan'];

    public function peminjaman() { return $this->belongsTo(Peminjaman::class, 'id_peminjaman', 'id_peminjaman'); }
    public function admin() { return $this->belongsTo(User::class, 'id_admin', 'id'); }
}
