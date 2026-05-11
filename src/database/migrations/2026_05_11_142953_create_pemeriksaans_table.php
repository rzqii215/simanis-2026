<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pasien_id')
                ->constrained('pasien')
                ->cascadeOnDelete();

            $table->foreignId('dokter_id')
                ->constrained('dokter')
                ->cascadeOnDelete();

            $table->date('tanggal_periksa');

            $table->text('keluhan');

            $table->text('diagnosa')
                ->nullable();

            $table->decimal('biaya', 12, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};
