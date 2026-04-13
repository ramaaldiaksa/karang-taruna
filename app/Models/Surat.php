<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surats';
    protected $primaryKey = 'id_surat';
    protected $fillable = ['id_admin', 'jenis_surat', 'judul', 'file_surat', 'tanggal_upload'];

    public function admin() { return $this->belongsTo(User::class, 'id_admin', 'id'); }
}
