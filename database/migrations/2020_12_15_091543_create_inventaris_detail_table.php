<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_detail', function (Blueprint $table) {
            $table->id();
            $table->enum('status_barang', ['Baik', 'Rusak']);
            $table->bigInteger('id_alat')->nullable()->unsigned();
            $table->foreign('id_alat')->references('id')->on('alat')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('id_inventaris')->nullable()->unsigned();
            $table->foreign('id_inventaris')->references('id')->on('inventaris')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('inventaris_detail');
    }
}
