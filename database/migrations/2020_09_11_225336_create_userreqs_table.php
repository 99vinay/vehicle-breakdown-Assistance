<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserreqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userreqs', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('item_id');
        $table->foreign('user_id')
          ->references('id')->on('users')
          ->onDelete('cascade');
          $table->unsignedBigInteger('customer_id');
          $table->foreign('customer_id')
            ->references('id')->on('customers')
            ->onDelete('cascade');
        $table->string('brand');
        $table->integer('Status')->nullable();
        $table->decimal('Longitude',9,6);
        $table->decimal('Latitude',9,6);
        $table->string('phone');
        $table->string('username');
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
        Schema::dropIfExists('userreqs');
    }
}
