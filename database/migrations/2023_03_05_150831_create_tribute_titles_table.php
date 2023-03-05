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
        Schema::create('tribute_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 64);
            $table->enum('type', ['Municipal','Estadual','Federal','Sindical','Outro']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tribute_titles');
    }
};
