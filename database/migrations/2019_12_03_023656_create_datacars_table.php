<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatacarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datacars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('IDCard_car')->nullable();
            $table->string('Brand_car')->nullable();
            $table->string('Version_car')->nullable();
            $table->string('Year_car')->nullable();
            $table->string('Regis_car')->nullable();
            $table->string('OpenBit_car')->nullable();
            $table->string('CloseBit_car')->nullable();
            $table->string('Note_car')->nullable();
            $table->string('Image_car')->nullable();
            
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
        Schema::dropIfExists('datacars');
    }
}
