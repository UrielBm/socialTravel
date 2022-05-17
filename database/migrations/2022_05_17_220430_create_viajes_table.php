<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_viajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('viajes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->comment("titulo del viaje");
            $table->text('topic_places')->comment("los lugares de interes por visitar");
            $table->text('description')->comment("descripción del viaje");
            $table->string('picture')->comment("la mejor foto del viaje");
            $table->integer('cost')->comment("el costo del viaje");
            $table->integer('days')->comment("dias que duro el viaje");
            $table->foreignId('user_id')->references('id')->on('users')->comment("El usuario que creo la entrada del viaje");
            $table->foreignId('categoria_id')->references('id')->on('categoria_viajes')->comment("La categoria del viaje que se ingreso");
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
        Schema::dropIfExists('viajes');
        Schema::dropIfExists('categoria_viajes');
    }
}
