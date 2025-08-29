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
    Schema::create('university_rankings', function (Blueprint $table) {
      $table->id();
      $table->text('title');
      $table->longText('description');
      $table->integer('position');
      $table->unsignedBigInteger('university_id');
      $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('university_rankings');
  }
};
