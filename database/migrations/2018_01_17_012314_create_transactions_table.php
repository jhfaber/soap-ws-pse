<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 255);
            $table->string('reference', 32)->unique();
            $table->integer('transactionID')->unsigned()->nullable();
            $table->string('sessionID', 32)->nullable();
            $table->string('trazabilityCode', 40)->nullable();
            $table->string('transactionState', 20)->nullable();
            $table->integer('responseCode')->unsigned()->nullable();
            $table->string('responseReasonText', 255)->nullable();
            $table->timestamps();

            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('transactions');
    }
}
