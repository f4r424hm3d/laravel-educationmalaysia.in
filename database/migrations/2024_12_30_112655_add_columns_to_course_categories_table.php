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
    Schema::table('course_categories', function (Blueprint $table) {
      $table->text('thumbnail_path')->after('content_image_path')->nullable();
      $table->text('banner_path')->after('thumbnail_path')->nullable();
      $table->text('og_image_path')->after('banner_path')->nullable();
      $table->integer('review_number')->after('seo_rating')->nullable();
      $table->decimal('best_rating', 2, 1)->after('review_number')->nullable();
      $table->longText('schema')->after('best_rating')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('course_categories', function (Blueprint $table) {
      //
    });
  }
};
