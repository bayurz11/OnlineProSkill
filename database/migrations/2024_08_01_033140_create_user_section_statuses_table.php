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
        Schema::create('section', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kurikulum_id');
            $table->string('title');
            $table->string('no_urut');
            $table->string('link');
            $table->string('duration');
            $table->string('file_path');
            $table->string('status');
            $table->foreign('kurikulum_id')->references('id')->on('section')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('user_section_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('section_id')->constrained('section')->onDelete('cascade'); // Pastikan nama tabel 'sections' disertakan
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section');
        Schema::dropIfExists('user_section_statuses');
    }
};
