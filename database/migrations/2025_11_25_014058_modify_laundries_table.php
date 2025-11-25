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
        Schema::create('laundries', function (Blueprint $table) {
            $table->bigIncrements('id_laundry'); // primary key

            // Foreign key ke tabel pelanggans dan layanans
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_layanan');

            // Kolom lainnya
            $table->string('resi', 25);
            $table->float('berat');
            $table->float('total_harga');
            $table->string('status', 50);
            $table->date('tgl_masuk');
            $table->date('tgl_selesai')->nullable();

            // Foreign key constraint
            $table->foreign('id_pelanggan')->references('id_pelanggan')->on('pelanggans')->onDelete('cascade');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laundries');
    }
};
