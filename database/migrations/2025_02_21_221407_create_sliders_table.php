<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_en'); // اسم باللغة الإنجليزية
            $table->string('title_ar'); // اسم باللغة العربية

            $table->text('description_en'); // وصف باللغة الإنجليزية
            $table->text('description_ar'); // وصف باللغة العربية

            $table->string('image_path'); // مسار الصورة

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
