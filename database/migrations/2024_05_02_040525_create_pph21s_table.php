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
        Schema::create('pph21s', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_bayar');
            $table->integer('bpf');
            $table->integer('biaya_bulan');
            $table->string('daftar_karyawan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pph21s');
    }
};
