<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusStockMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_masuk', function (Blueprint $table) {
            $table->smallInteger('status')->default(0)->after('keterangan');
            $table->text('deskripsi')->after('status')->default('-');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_masuk', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('deskripsi');
        });
    }
}
