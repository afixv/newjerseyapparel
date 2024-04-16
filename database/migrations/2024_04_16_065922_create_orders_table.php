<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_customer');
            $table->string('no_hp');
            $table->string('alamat')->nullable();
            $table->integer('status')->default(0);
            $table->integer('total_harga');
            $table->integer('jumlah_pesanan');
            $table->string('keterangan');
            $table->string('link_desain')->nullable();
            $table->string('request_desain')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
