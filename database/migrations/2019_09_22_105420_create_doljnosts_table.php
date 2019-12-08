<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoljnostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doljnost', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('otdel_id')->unsigned()->index();
            $table->bigInteger('name_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table("doljnost", function(Blueprint $table){
            $table->foreign('otdel_id')->references('id')->on('otdel');
            $table->foreign('name_id')->references('id')->on('doljnosti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doljnosts');
    }
}
