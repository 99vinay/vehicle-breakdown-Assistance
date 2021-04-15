<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerivetabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derivetabs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');
              $table->unsignedBigInteger('customer_id');
            $table->integer('Status');
            $table->string('name');
            $table->string('place');
            $table->decimal('Longitude',9,6);
            $table->decimal('Latitude',9,6);
            $table->float('distance');
            $table->mediumText('image');
            $table->string('working');
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
        Schema::dropIfExists('derivetabs');
    }
}
