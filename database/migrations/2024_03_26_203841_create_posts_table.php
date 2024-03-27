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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->smallInteger('rooms');
            $table->Integer('size');
            $table->unsignedFloat('price');
            $table->string('description');
            $table->string('picture')->nullable();
            $table->string('file');
            $table->string('region');
            $table->string('city');
            $table->string('address');
            $table->string('landlord_email');
            $table->unsignedBigInteger('landlord_phone');
            $table->Integer('likes')->default(0);
            $table->boolean('is_published')->default(0);


            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
