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
        Schema::create('kaderisasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_manager')->unsigned()->nullable();
            $table->foreign('id_manager')->references('id')->on('users');
            $table->bigInteger('id_admin_corporate')->unsigned()->nullable();
            $table->foreign('id_admin_corporate')->references('id')->on('users');
            $table->bigInteger('id_karyawan_junior')->unsigned()->nullable();
            $table->foreign('id_karyawan_junior')->references('id')->on('karyawans');
            $table->bigInteger('id_karyawan_senior')->unsigned()->nullable();
            $table->foreign('id_karyawan_senior')->references('id')->on('karyawans');
            $table->text('uraian_keilmuan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaderisasis');
    }
};
