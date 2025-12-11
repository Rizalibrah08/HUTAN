<?php
// database/migrations/2024_01_01_000002_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->default('fa-tag');
            $table->string('color')->default('#4CAF50');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Insert default categories
        DB::table('categories')->insert([
            [
                'name' => 'Pencemaran Air',
                'slug' => 'pencemaran-air',
                'description' => 'Laporan terkait pencemaran sungai, danau, atau sumber air lainnya',
                'icon' => 'fa-water',
                'color' => '#2196F3',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sampah dan Limbah',
                'slug' => 'sampah-limbah',
                'description' => 'Laporan tentang penumpukan sampah atau pembuangan limbah ilegal',
                'icon' => 'fa-trash',
                'color' => '#4CAF50',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Deforestasi',
                'slug' => 'deforestasi',
                'description' => 'Laporan penebangan liar atau kerusakan hutan',
                'icon' => 'fa-tree',
                'color' => '#8BC34A',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Polusi Udara',
                'slug' => 'polusi-udara',
                'description' => 'Laporan asap pabrik, pembakaran, atau polusi udara lainnya',
                'icon' => 'fa-smog',
                'color' => '#9E9E9E',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kerusakan Lahan',
                'slug' => 'kerusakan-lahan',
                'description' => 'Laporan erosi, tanah longsor, atau kerusakan lahan lainnya',
                'icon' => 'fa-mountain',
                'color' => '#795548',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keanekaragaman Hayati',
                'slug' => 'keanekaragaman-hayati',
                'description' => 'Laporan terkait satwa liar atau tumbuhan langka',
                'icon' => 'fa-paw',
                'color' => '#FF9800',
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lainnya',
                'slug' => 'lainnya',
                'description' => 'Laporan kerusakan lingkungan lainnya',
                'icon' => 'fa-ellipsis-h',
                'color' => '#607D8B',
                'sort_order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};