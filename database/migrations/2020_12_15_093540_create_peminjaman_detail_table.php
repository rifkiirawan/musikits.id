<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id();
            $table->decimal('harga', 14, 2);
            $table->bigInteger('id_alat')->nullable()->unsigned();
            $table->foreign('id_alat')->references('id')->on('alat')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_peminjaman')->nullable()->unsigned();
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_detail');
    }
}
