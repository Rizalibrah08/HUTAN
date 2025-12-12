<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomorTiketToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            if (!Schema::hasColumn('reports', 'nomor_tiket')) {
                $table->string('nomor_tiket')->nullable()->after('id');
            }
            if (!Schema::hasColumn('reports', 'catatan_admin')) {
                $table->text('catatan_admin')->nullable()->after('category');
            }
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['nomor_tiket', 'catatan_admin']);
        });
    }
}