<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('design_uploads')) {
            return;
        }

        Schema::create('design_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('company');
            $table->string('looking_for');
            $table->json('files')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('status', 32)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_uploads');
    }
};
