<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("fn");
            $table->string("mn");
            $table->string("ln")->default(null)->nullable();
            $table->bigInteger('doljnost_id')->unsigned()->index();
            $table->bigInteger('zvanie_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::table("persona", function(Blueprint $table){
            $table->foreign('doljnost_id')->references('id')->on('doljnost');
            $table->foreign('zvanie_id')->references('id')->on('zvanie_lists');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
