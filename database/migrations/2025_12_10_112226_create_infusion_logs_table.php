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
        Schema::create('infusion_logs', function (Blueprint $table) {
            $table->id();
            $table->string('device_id');      // Kode Alat (misal: INF-01)
            $table->float('current_weight');  // Berat Sisa (ml)
            $table->float('drop_rate');       // Kecepatan Tetes (TPM)
            $table->timestamps();             // Waktu pencatatan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infusion_logs');
    }
};
