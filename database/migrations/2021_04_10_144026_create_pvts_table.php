<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePvtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pvts', function (Blueprint $table) {
            $table->id();
            $table->uuid("code_unique");
            $table->date("date_effet");
            $table->date("date_exp");
            $table->date("date_use_vehic");
            $table->string("immatriculation")->unique();
            $table->string("zone_c_vehicul");
            $table->date("date_mise_en_circulation");
            $table->unsignedBigInteger("valeur_residuelle");
            $table->unsignedBigInteger("valeur_venale");
            $table->string("marque");
            $table->string("modele");
            $table->unsignedBigInteger('proprietaire_id');
            $table->foreign('proprietaire_id')->references('id')->on('proprietaires');
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
        Schema::dropIfExists('pvts');
    }
}
