<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAlatPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('total_harga');
            $table->bigInteger('id_alat')->nullable()->unsigned();
            $table->foreign('id_alat')->references('id')->on('alat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->decimal('total_harga', 14, 2);
            $table->dropForeign(['id_alat']);
            $table->dropColumn('id_alat');
        });
    }
}
