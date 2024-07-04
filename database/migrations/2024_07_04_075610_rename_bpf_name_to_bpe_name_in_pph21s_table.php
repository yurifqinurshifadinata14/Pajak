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
        Schema::table('pph21s', function (Blueprint $table) {
            if (Schema::hasColumn('pph21s', 'bpf')) {
                $table->renameColumn('bpf', 'bpe');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pph21s', function (Blueprint $table) {
            if (Schema::hasColumn('pph21s', 'bpe')) {
                $table->renameColumn('bpe', 'bpf');
            }
        });
    }
};
