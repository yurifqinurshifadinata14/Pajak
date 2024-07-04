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
        Schema::table('pphunifikasis', function (Blueprint $table) {
            if (Schema::hasColumn('pphunifikasis', 'bpf')) {
                $table->renameColumn('bpf', 'bpe');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pphunifikasis', function (Blueprint $table) {
            if (Schema::hasColumn('pphunifikasis', 'bpe')) {
                $table->renameColumn('bpe', 'bpf');
            }
        });
    }
};
