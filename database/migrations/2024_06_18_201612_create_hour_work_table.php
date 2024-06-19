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
        Schema::create('hour_works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('hour')->comment('Отработанные часы');
            $table->bigInteger('amount')->comment('Зарплата за отработанное время, сумма указана в копейках');
            $table->boolean('paid')->default(false)->comment('Статус оплачены часы или нет');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hour_works');
    }
};
