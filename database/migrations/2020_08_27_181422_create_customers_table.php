<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->decimal('Longitude',9,6);
            $table->decimal('Latitude',9,6);
            $table->string('name');
            $table->string('Place');
            $table->string('Email');
            $table->string('customer_name');
            $table->string('Password');
            $table->string('working');
            $table->mediumText('image')->nullable();
            $table->string('Phone');
            $table->integer('Status')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
