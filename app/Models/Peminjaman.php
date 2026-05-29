<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';
    protected $fillable = ['id_masyarakat', 'id_admin', 'tanggal_pengajuan', 'tanggal_pinjam', 'rencana_kembali', 'status'];

    public function masyarakat() { return $this->belongsTo(Masyarakat::class, 'id_masyarakat', 'id_masyarakat'); }
    public function admin() { return $this->belongsTo(User::class, 'id_admin', 'id'); }
    public function detail() { return $this->hasMany(DetailPeminjaman::class, 'id_peminjaman', 'id_peminjaman'); }
    public function pengembalian() { return $this->hasOne(Pengembalian::class, 'id_peminjaman', 'id_peminjaman'); }
}
