<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->date('date');
            $table->decimal('weight', 4, 1);

            $table->integer('calories');
            $table->time('exercise_time');
            $table->text('exercise_content');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weight_logs');
    }
};

