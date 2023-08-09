<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id('id_rating');
            $table->unsignedBigInteger('id_wisatawan');
            $table->foreign('id_wisatawan')->references('id_wisatawan')->on('wisatawans');
            $table->unsignedBigInteger('id_wisata');
            $table->foreign('id_wisata')->references('id_wisata')->on('wisata');
            $table->float('rating_wisata');
            $table->string('comment')->nullable(); ;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rating');
    }
}
