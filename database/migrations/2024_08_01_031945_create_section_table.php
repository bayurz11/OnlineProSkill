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
            $table->foreign('kurikulum_id')->references('id')->on('kurikulum')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section');
    }
};
