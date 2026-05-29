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
        Schema::create('surats', function (Blueprint $table) {
            $table->id('id_surat');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('jenis_surat');
            $table->string('judul');
            $table->string('file_surat')->nullable();
            $table->date('tanggal_upload');
            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
