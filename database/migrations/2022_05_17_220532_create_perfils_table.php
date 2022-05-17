<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->string("avatar")->nullable()->comment("foto del avatar del perfil del usuario");
            $table->text("biography")->nullable()->comment("la biografia del perfil del usuario");
            $table->string("instagram")->nullable()->comment("instagram del perfil del usuario");
            $table->string("twitter")->nullable()->comment("twitter del perfil del usuario");
            $table->foreignId('user_id')->references('id')->on('users')->comment("El usuario asociado al perfil");
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
        Schema::dropIfExists('perfils');
    }
}
