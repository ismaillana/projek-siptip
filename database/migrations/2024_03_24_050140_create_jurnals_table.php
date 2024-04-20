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
        Schema::create('jurnals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penugasan_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('file_jurnal')->nullable();
            $table->string('file_revisi')->nullable();
            $table->text('uraian_revisi')->nullable();
            $table->string('file_revisi_manager')->nullable();
            $table->text('uraian_revisi_manager')->nullable();
            $table->enum('status_jurnal', ['Belum Dikerjakan', 'Review', 'Review Manager', 'Revisi Senior', 'Revisi Manager', 'Selesai'])->default('Belum Dikerjakan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnals');
    }
};
