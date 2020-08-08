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
            $table->bigInteger('persona_id')->unsigned()->index()->nullable()->default(null);
            $table->bigInteger('upravlenie_id')->unsigned()->index()->nullable()->default(null);
            $table->bigInteger('doljnost_list_id')->unsigned()->index();
        });
        Schema::table("doljnost", function(Blueprint $table){
            $table->foreign('persona_id')->references('id')->on('persona');
            $table->foreign('upravlenie_id')->references('id')->on('upravlenie');
            $table->foreign('doljnost_list_id')->references('id')->on('doljnost_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doljnost');
    }
}
