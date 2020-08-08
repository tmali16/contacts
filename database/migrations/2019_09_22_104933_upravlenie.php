<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Upravlenie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upravlenie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullname');
            $table->string("shortname")->nullable()->default(null);
            // $table->bigInteger('gu_id')->unsigned()->index()->nullable()->default(null);
            $table->bigInteger('parent_id')->unsigned()->index()->nullable()->default(null);
            // $table->timestamps();
        });

        Schema::table("upravlenie", function(Blueprint $table){
            // $table->foreign('gu_id')->references('id')->on('gupravlenie');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upravlenie');
    }
}
