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
            $table->bigInteger('upr_id')->unsigned()->index()->nullable()->default(null);
            $table->bigInteger('gu_id')->unsigned()->index()->nullable()->default(null);
            $table->bigInteger('name_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table("doljnost", function(Blueprint $table){
            $table->foreign('upr_id')->references('id')->on('upravlenie');
            $table->foreign('gu_id')->references('id')->on('gupravlenie');
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
