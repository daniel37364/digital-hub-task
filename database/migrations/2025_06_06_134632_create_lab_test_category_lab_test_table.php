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
        Schema::create('lab_test_category_pivot', function (Blueprint $table) {
            $table->uuid('lab_test_id');
            $table->uuid('lab_test_category_id');

            $table->primary(['lab_test_id', 'lab_test_category_id']);

            $table->foreign('lab_test_id')->references('id')->on('lab_tests')->onDelete('cascade');
            $table->foreign('lab_test_category_id')->references('id')->on('lab_test_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_test_category_lab_test');
    }
};
