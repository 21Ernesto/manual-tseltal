<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('palabras', function (Blueprint $table) {
            $table->id();
            $table->string('ortografia')->nullable();
            $table->string('traduccion')->nullable();
            $table->string('audio')->nullable();
            $table->unsignedBigInteger('capitulo_id')->nullable();
            $table->text('observacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palabras');
    }
};
