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
        Schema::create('pphunifikasis', function (Blueprint $table) {
            $table->id();
            $table->integer('ntpn')->nullable();
            $table->integer('jumlah_bayar')->nullable();
            $table->integer('biaya_bulan')->nullable();
            $table->string('bpf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pphunifikasis');
    }
};
