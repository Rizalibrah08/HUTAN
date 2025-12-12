<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reports', function (Blueprint $table) {
        // $table->string('nomor_tiket')->nullable()->after('id');
        $table->text('admin_notes')->nullable()->after('status_id');
        $table->timestamp('completed_at')->nullable()->after('admin_notes');
        $table->string('attachment')->nullable()->after('admin_notes');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            //
        });
    }
};
