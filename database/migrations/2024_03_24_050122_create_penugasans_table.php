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
        Schema::create('penugasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kaderisasi_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('tugas');
            $table->date('tanggal_awal');
            $table->date('tanggal_akhir');
            $table->integer('id_manager')->nullable();
            $table->text('uraian_penugasan')->nullable();
            $table->enum('status', ['Belum Dikerjakan', 'Review', 'Revisi', 'Selesai'])->default('Belum Dikerjakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasans');
    }
};
