<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('gallery_category')) {
            Schema::create('gallery_category', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedTinyInteger('status')->default(1);
                $table->unsignedTinyInteger('active')->default(0);
                $table->timestamps();
            });
        } else {
            Schema::table('gallery_category', function (Blueprint $table) {
                if (!Schema::hasColumn('gallery_category', 'status')) {
                    $table->unsignedTinyInteger('status')->default(1)->after('name');
                }
                if (!Schema::hasColumn('gallery_category', 'active')) {
                    $table->unsignedTinyInteger('active')->default(0)->after('status');
                }
                if (!Schema::hasColumn('gallery_category', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('gallery_category', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        }

        if (!Schema::hasTable('gallery')) {
            Schema::create('gallery', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cat_id')->nullable()->index();
                $table->string('title')->nullable();
                $table->string('image')->nullable();
                $table->unsignedTinyInteger('status')->default(1);
                $table->timestamps();
            });
        } else {
            Schema::table('gallery', function (Blueprint $table) {
                if (!Schema::hasColumn('gallery', 'cat_id')) {
                    $table->unsignedBigInteger('cat_id')->nullable()->index();
                }
                if (!Schema::hasColumn('gallery', 'title')) {
                    $table->string('title')->nullable()->after('cat_id');
                }
                if (!Schema::hasColumn('gallery', 'image')) {
                    $table->string('image')->nullable()->after('title');
                }
                if (!Schema::hasColumn('gallery', 'status')) {
                    $table->unsignedTinyInteger('status')->default(1)->after('image');
                }
                if (!Schema::hasColumn('gallery', 'created_at')) {
                    $table->timestamp('created_at')->nullable();
                }
                if (!Schema::hasColumn('gallery', 'updated_at')) {
                    $table->timestamp('updated_at')->nullable();
                }
            });
        }
    }

    public function down(): void
    {
        // Keep tables for backward compatibility.
    }
};
