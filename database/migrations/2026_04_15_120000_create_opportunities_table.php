<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('opportunities')) {
            return;
        }

        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->string('designation_name');
            $table->longText('job_description')->nullable();
            $table->string('location')->nullable();
            $table->string('qualification')->nullable();
            $table->string('experience')->nullable();
            $table->string('email')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
