<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pphs', function (Blueprint $table) {
            $table->id();
            $table->string('id_pajak');
            $table->string('id_pph');
            $table->integer('ntpn');
            $table->integer('biaya_bulan');
            $table->integer('jumlah_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pphs');
    }
};
