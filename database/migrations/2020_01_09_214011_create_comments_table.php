<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     * Las relaciones polimorfas permiten a un modelo
     * pertenecer a más de un modelo en una sola asociación.
     * Por ejemplo, imaginar usuarios que pueden "comentar"
     * tanto posts como vídeos. Utilizando relaciones polimórficas,
     * se puede utilizar una única tabla comments para ambos escenarios
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('body');

            //polimorfismo entre tablas
            $table->morphs('commentable');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
