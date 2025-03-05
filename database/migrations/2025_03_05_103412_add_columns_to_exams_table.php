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
    Schema::table('exams', function (Blueprint $table) {
      $table->decimal('seo_rating', 3, 1)->nullable()->after('page_content');
      $table->decimal('best_rating', 3, 1)->nullable()->after('seo_rating'); // Allows values like 4.5, 3.5
      $table->integer('review_number')->nullable()->after('best_rating');
      $table->string('og_image')->nullable()->after('review_number');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('exams', function (Blueprint $table) {
      $table->dropColumn(['seo_rating', 'best_rating', 'review_number', 'og_image']);
    });
  }
};
