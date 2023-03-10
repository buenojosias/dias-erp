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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->string('title', 200);
            $table->string('contract_number')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('amount');
            $table->integer('installments');
            $table->enum('status', ['Aguardando','Em execução','Interrompida','Concluída','Atrasada']);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
