<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_wisatas', function (Blueprint $table) {
            $table->id('id_review');
            $table->integer('id_wisatas');
            $table->integer('rating_1')->default(0);
            $table->integer('rating_2')->default(0);
            $table->integer('rating_3')->default(0);
            $table->integer('rating_4')->default(0);
            $table->integer('rating_5')->default(0);
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
        Schema::dropIfExists('review_wisatas');
    }
}
