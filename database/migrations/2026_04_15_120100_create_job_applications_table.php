<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('job_applications')) {
            return;
        }

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id')->nullable()->index();
            $table->string('designation')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 40)->nullable();
            $table->text('comment')->nullable();
            $table->string('resume')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
