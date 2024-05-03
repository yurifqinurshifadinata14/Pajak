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
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pajak')->constrained('pajaks');
            $table->enum('status',['PKP','Non PKP']);
            $table->string('enofa_password')->nullable();
            $table->string('user_efaktur')->nullable();
            $table->string('passphrese')->nullable();
            $table->string('password_efaktur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
