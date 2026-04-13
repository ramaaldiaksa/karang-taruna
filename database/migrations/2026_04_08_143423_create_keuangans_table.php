<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id('id_keuangan');
            $table->unsignedBigInteger('id_admin');
            $table->decimal('jumlah', 15, 2);
            $table->enum('jenis_transaksi', ['pemasukan', 'pengeluaran']);
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
