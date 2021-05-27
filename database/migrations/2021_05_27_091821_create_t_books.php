<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('autor');
            $table->string('editorial');
            $table->string('genre');
            $table->string('language');
            $table->string('type');
            $table->string('edition');
            $table->string('ISBN');
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
        Schema::dropIfExists('t_books');
    }
}
