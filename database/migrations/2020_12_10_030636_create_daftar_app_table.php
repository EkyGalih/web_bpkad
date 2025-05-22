<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarAppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_app', function (Blueprint $table) {
            $table->string('id', 40)->primary();
            $table->string('name', 50)->nullable();
            $table->string('deskripsi', 100)->nullable();
            $table->string('versi', 4);
            $table->string('icon', 255);
            $table->string('url', 255);
            $table->string('order_item', 11)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_app');
    }
}
