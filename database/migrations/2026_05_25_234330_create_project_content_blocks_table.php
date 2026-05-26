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
        Schema::create('project_content_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->contrained()->cascadeOnDelete();
            $table->string('type', 20);
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_content_blocks');
    }
};
