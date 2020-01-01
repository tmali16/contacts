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
            $table->bigInteger('parent_id')->unsigned()->index();
            $table->bigInteger('doljnost_id')->unsigned()->index();
        });
        Schema::table("doljnost", function(Blueprint $table){
            $table->foreign('parent_id')->references('id')->on('gupravlenie');
            $table->foreign('doljnost_id')->references('id')->on('doljnost_lists');
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
