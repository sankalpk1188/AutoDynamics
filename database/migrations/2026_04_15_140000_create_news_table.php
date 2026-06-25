<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('category')->nullable();
                $table->longText('description')->nullable();
                $table->date('date')->nullable();
                $table->string('image')->nullable();
                $table->unsignedTinyInteger('status')->default(1);
                $table->timestamps();
            });
            return;
        }

        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'category')) {
                $table->string('category')->nullable()->after('title');
            }
            if (!Schema::hasColumn('news', 'date')) {
                $table->date('date')->nullable()->after('description');
            }
            if (!Schema::hasColumn('news', 'status')) {
                $table->unsignedTinyInteger('status')->default(1)->after('image');
            }
            if (!Schema::hasColumn('news', 'created_at')) {
                $table->timestamp('created_at')->nullable();
            }
            if (!Schema::hasColumn('news', 'updated_at')) {
                $table->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        // Keep table for backward compatibility.
    }
};
