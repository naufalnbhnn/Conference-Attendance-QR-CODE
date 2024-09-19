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
    Schema::create('visitors', function (Blueprint $table) {
        $table->id();
        $table->string('name')->default('Anonymous');
        $table->string('email')->nullable(); // Ubah email menjadi nullable
        $table->string('affiliation')->nullable();
        $table->string('qr_code')->nullable(); // kolom untuk menyimpan QR code
        $table->timestamps();
    });    

    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};
