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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('radio')->default('Radio');
            $table->string('radio_image')->nullable(); 
            $table->string('radio_link')->nullable(); 
            $table->string('tv_en_vivo')->default('TV EN Vivo');
            $table->string('tv_en_vivo_image')->nullable(); 
            $table->string('tv_en_vivo_link')->nullable(); 
            $table->string('youtube')->default('Youtube');
            $table->string('youtube_image')->nullable(); 
            $table->string('youtube_link')->nullable(); 
            $table->string('facebook')->default('Facebook');
            $table->string('facebook_image')->nullable(); 
            $table->string('facebook_link')->nullable(); 
            $table->string('instagram')->default('Instagram');
            $table->string('instagram_image')->nullable(); 
            $table->string('instagram_link')->nullable(); 
            $table->string('books')->default('Books');
            $table->string('books_image')->nullable(); 
            $table->string('books_link')->nullable(); 
            $table->string('books_sharp')->default('Books Sharp');
            $table->string('books_sharp_image')->nullable(); 
            $table->string('books_sharp_link')->nullable(); 
            $table->string('web')->default('Web');
            $table->string('web_image')->nullable(); 
            $table->string('web_link')->nullable(); 
            $table->string('phone')->default('Phone');
            $table->string('phone_image')->nullable(); 
            $table->string('phone_link')->nullable(); 
            $table->string('donate')->default('Donate');
            $table->string('donate_image')->nullable(); 
            $table->string('donate_link')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
