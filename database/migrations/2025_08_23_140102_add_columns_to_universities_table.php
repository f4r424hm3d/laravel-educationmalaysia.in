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
    Schema::table('universities', function (Blueprint $table) {
      $table->boolean('featured')->default(false)->after('partner');
      $table->string('latitude_longitude')->nullable()->after('featured');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('universities', function (Blueprint $table) {
      $table->dropColumn('featured');
      $table->dropColumn('latitude_longitude');
    });
  }
};
