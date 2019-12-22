<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtdelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otdel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string("shortname")->nullable()->default(null);
            $table->bigInteger('upr_id')->unsigned()->index();
            $table->timestamps();
        });
        // Schema::table("otdel", function(Blueprint $table){
        //     $table->foreign('upr_id')->references('id')->on('upravlenie');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otdel');
    }
}
