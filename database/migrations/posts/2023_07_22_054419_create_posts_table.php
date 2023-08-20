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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('thumbnail')->nullable()->default(asset('static/default_thumbnail.png'));
            $table->string('slug')->unique();
            $table->text('body')->nullable();
            $table->tinyInteger('status');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_comment')->default(1);
            $table->boolean('is_private')->default(0);
            $table->tinyInteger('layout');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'slug', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
