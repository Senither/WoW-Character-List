<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('realm');
            $table->string('avatar')->nullable();
            $table->string('title')->nullable();
            $table->integer('level')->default(0);
            $table->string('race')->nullable();
            $table->string('talent')->nullable();
            $table->string('class')->nullable();
            $table->integer('ilvl_equipd')->default(0);
            $table->integer('ilvl_avg')->default(0);
            $table->string('guild')->nullable();
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
        Schema::dropIfExists('characters');
    }
}
