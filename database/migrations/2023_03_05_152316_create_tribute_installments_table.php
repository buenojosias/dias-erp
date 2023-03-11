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
        Schema::create('tribute_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tribute_id')->constrained();
            $table->integer('amount');
            $table->date('expiration_date')->nullable();
            $table->date('payment_date')->nullable();
            $table->enum('status', ['Pendente','Pago','Atrasado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tribute_installments');
    }
};
