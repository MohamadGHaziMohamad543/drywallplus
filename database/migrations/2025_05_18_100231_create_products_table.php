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
       Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name_ar');
        $table->string('name_en');
        $table->text('description_ar');
        $table->text('description_en');
        $table->text('overview_ar')->nullable();
        $table->text('overview_en')->nullable();
        $table->text('details_ar')->nullable();
        $table->text('details_en')->nullable();
        $table->unsignedBigInteger('sub_sub_category_id');
        $table->string('image')->nullable();
            $table->json('images')->nullable(); // صور متعددة

        $table->json('catalogs')->nullable();
        $table->json('safety_data_sheets')->nullable();
        $table->json('product_catalogs')->nullable();
        $table->json('installation_guides')->nullable();
        $table->json('product_files')->nullable();
        $table->json('warranties')->nullable();
        $table->json('company_files')->nullable();
        $table->timestamps();

        $table->foreign('sub_sub_category_id')->references('id')->on('sub_sub_categories')->onDelete('cascade');
    });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
