<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_masuk', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->bigInteger('sarana_id')->unsigned();
            $table->bigInteger('ruangan_id')->unsigned();
            $table->integer('qty');
            $table->text('keterangan');
            $table->timestamps();
            $table->foreign('ruangan_id')->references('id')->on('ruangan');
            $table->foreign('sarana_id')->references('id')->on('sarana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_masuk');
    }
}
