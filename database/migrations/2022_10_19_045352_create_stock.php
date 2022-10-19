<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ruangan_id')->unsigned();
            $table->bigInteger('sarana_id')->unsigned();
            $table->integer('qty');
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
        Schema::dropIfExists('stocks');
    }
}
