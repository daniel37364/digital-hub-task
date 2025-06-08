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
        Schema::create('lab_test_synonyms', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lab_test_id');
            $table->uuid('synonym_id');

            $table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade');
            $table->foreign('synonym_id')->references('id')->on('synonyms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_synonyms');
    }
};
