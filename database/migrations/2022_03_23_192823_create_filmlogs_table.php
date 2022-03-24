<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filmlogs', function (Blueprint $table) {
            $table->id();
            $table->boolean('active')->default(1);
            $table->integer('film_id');
            $table->integer('user_id');
            $table->boolean('favorite')->default(false);
            $table->longtext('note')->nullable();
            $table->integer('order')->nullable();
            $table->enum('status', ['seen', 'watchlist']);
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
        Schema::dropIfExists('filmlogs');
    }
}
