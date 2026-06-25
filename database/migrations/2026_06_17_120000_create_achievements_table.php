<?php

use App\Support\AchievementDefaults;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('achievements')) {
            return;
        }

        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('type', 40);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('alt')->nullable();
            $table->string('identifier')->nullable();
            $table->string('image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });

        $now = now();
        foreach (AchievementDefaults::items() as $item) {
            DB::table('achievements')->insert([
                'type' => $item['type'],
                'title' => $item['title'],
                'description' => $item['description'],
                'alt' => $item['alt'],
                'identifier' => $item['identifier'],
                'image' => $item['image'],
                'sort_order' => $item['sort_order'],
                'status' => $item['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        // Keep table for backward compatibility.
    }
};
