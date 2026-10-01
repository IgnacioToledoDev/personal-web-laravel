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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('user');
            $table->string('host');
            $table->string('path')->default('~');
            $table->text('ascii');
            $table->string('neofetch_title_name');
            $table->string('neofetch_title_host');
            $table->json('neofetch_rows');
            $table->text('about_lead');
            $table->json('about_meta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
