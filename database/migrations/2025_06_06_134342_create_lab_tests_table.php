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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('code')->unique();
            $table->string('code_icd', 20)->unique();
            $table->uuid('name_lang_set_id');
            $table->uuid('description_lang_set_id');
            $table->boolean('public');
            $table->boolean('deleted');
            $table->integer('ord');

            $table->foreign('name_lang_set_id')->references('id')->on('lang_sets')->onDelete('cascade');
            $table->foreign('description_lang_set_id')->references('id')->on('lang_sets')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
