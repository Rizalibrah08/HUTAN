<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('title');
            $table->text('content');
            $table->date('date');
            $table->string('location');
            $table->string('category');
            
            // PAKAI INI - TANPA FOREIGN KEY DULU
            $table->unsignedBigInteger('status_id')->default(1);
            
            $table->string('verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('email');
            $table->index('status_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};