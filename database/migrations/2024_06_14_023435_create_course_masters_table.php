<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('course_master', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kursus');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('subkategori_id')->nullable();
            $table->text('deskripsi');
            $table->string('tingkat');
            $table->json('include');
            $table->json('perstaratan');
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->decimal('discountedPrice', 10, 2)->nullable();
            $table->boolean('free')->default(false);
            $table->string('gambar')->nullable();
            $table->string('tag')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subkategori_id')->references('id')->on('subcategories')->onDelete('set null');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_master');
    }
};
