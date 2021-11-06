<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult');
            $table->string('backdrop_path');
            $table->json('genre_ids');
            $table->bigInteger('movie_id');
            $table->string('original_language');
            $table->text('original_title');
            $table->longText('overview');
            $table->float('popularity');
            $table->string('poster_path');
            $table->date('release_date');
            $table->text('title');
            $table->boolean('video');
            $table->float('vote_average');
            $table->bigInteger('vote_count');
            $table->enum('type_of_movie',['top_rated','popular']);
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
        Schema::dropIfExists('movies');
    }
}
