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
    Schema::table('levels', function (Blueprint $table) {
      $table->string('short_name_slug', 100)->after('short_name')->nullable();
      $table->string('seo_name_slug', 100)->after('seo_name')->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('levels', function (Blueprint $table) {
      $table->dropColumn('short_name_slug');
      $table->dropColumn('seo_name_slug');
    });
  }
};
