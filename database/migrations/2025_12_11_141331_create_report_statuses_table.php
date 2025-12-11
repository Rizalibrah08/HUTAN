<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('report_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color')->default('#6c757d');
            $table->timestamps();
        });

        // Insert data
        DB::table('report_statuses')->insert([
            ['name' => 'Menunggu Verifikasi', 'color' => '#ffc107', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Terverifikasi', 'color' => '#17a2b8', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Dalam Investigasi', 'color' => '#007bff', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Diproses', 'color' => '#28a745', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Selesai', 'color' => '#6c757d', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ditolak', 'color' => '#dc3545', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('report_statuses');
    }
};