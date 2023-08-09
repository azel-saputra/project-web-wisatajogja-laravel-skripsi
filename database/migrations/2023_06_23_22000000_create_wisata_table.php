<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id('id_wisata');
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori');
            
            $table->unsignedBigInteger('id_total_rating')->nullable();
            $table->foreign('id_total_rating')->references('id_total_rating')->on('total_ratings');

            $table->unsignedBigInteger('id_review')->nullable();
            $table->foreign('id_review')->references('id_review')->on('review_wisatas');


            // $table->unsignedBigInteger('id_rating')->nullable();
            // $table->foreign('id_rating')->references('id_rating')->on('rating');

            $table->string('nama_wisata');
            $table->string('alamat');
            $table->string('harga');
            $table->string('jam_buka');
            $table->string('jam_tutup');
            $table->text('sejarah');
            $table->string('fasilitas');
            $table->text('gambar');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('wisata');
    }
}
