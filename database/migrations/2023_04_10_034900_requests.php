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
        //
        // Schema::create('requests', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->string('nama');
        //     $table->string('gambar');
        //     $table->integer('harga');
        //     $table->string('deskripsi');
        //     $table->timestamps();
        // });
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('gambar');
            $table->integer('harga');
            $table->string('deskripsi');
            $table->enum('kondisi', ['baru', 'bekas']);
            $table->string('alamat');
            $table->integer('kuantitas');
            $table->string('kota');
            $table->string('provinsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('requests');
    }
};
