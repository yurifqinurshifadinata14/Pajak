<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pajaks', function (Blueprint $table) {
            $table->index('id_pajak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pajaks', function (Blueprint $table) {
            $table->dropIndex(['id_pajak']);
        });
    }
};
