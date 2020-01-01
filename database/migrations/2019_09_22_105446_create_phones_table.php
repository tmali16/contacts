<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("number");
            $table->bigInteger('type_id')->unsigned()->index();
            $table->bigInteger('persona_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table("phone", function(Blueprint $table){
            $table->foreign('type_id')->references('id')->on('phone_type');
            $table->foreign('persona_id')->references('id')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
