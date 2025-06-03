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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            // الأسماء باللغة المختلفة
            $table->string('name_en');
            $table->string('name_ar');
            
            // الأوصاف باللغة المختلفة
            $table->longText('desc_en');
            $table->longText('desc_ar');
            
            // صورة واحدة
            $table->string('image')->nullable();
            
            // مجموعة صور
            $table->json('images')->nullable(); // لاستخدام الصور المتعددة

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
