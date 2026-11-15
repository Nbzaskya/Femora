<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('log_date');

            // Menyimpan beberapa gejala dalam format JSON
            $table->json('symptoms')->nullable();

            // Suasana hati pengguna
            $table->string('mood', 50)->nullable();

            // Catatan tambahan
            $table->text('notes')->nullable();

            $table->timestamps();

            // Satu pengguna hanya memiliki satu jurnal per tanggal
            $table->unique(['user_id', 'log_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
