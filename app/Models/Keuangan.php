<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangans';
    protected $primaryKey = 'id_keuangan';
    protected $fillable = ['id_admin', 'jumlah', 'jenis_transaksi', 'tanggal', 'keterangan', 'bukti_transaksi'];

    public function admin() { return $this->belongsTo(User::class, 'id_admin', 'id'); }
}
