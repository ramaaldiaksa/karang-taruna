<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $primaryKey = 'id_inventaris';
    protected $fillable = ['kode_barang', 'nama_barang', 'tanggal_masuk', 'jumlah_total', 'jumlah_tersedia'];
    protected $casts = ['tanggal_masuk' => 'date'];
}
