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
        Schema::create('riwayat_pengangkutans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tps_id')->constrained('t_p_s')->onDelete('cascade');
            $table->timestamp('waktu_pengangkutan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengangkutans');
    }
};
