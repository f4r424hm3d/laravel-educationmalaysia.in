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
    Schema::create('blog_faqs', function (Blueprint $table) {
      $table->id();
      $table->text('question');
      $table->longText('answer');
      $table->unsignedBigInteger('blog_id');
      $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('blog_faqs');
  }
};
