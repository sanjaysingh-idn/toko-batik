<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('province_id');
            $table->string('city_id');
            $table->string('courier');
            $table->string('service');
            $table->string('address');
            $table->string('pos_code');
            $table->string('catatan')->nullable();
            $table->bigInteger('ongkir');
            $table->bigInteger('weight');
            $table->bigInteger('total_shopping');
            $table->enum('status', ['unpaid', 'paid', 'dikirim', 'selesai'])->default('unpaid');
            $table->string('resi')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanans');
    }
}
