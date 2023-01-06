<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('numeroAnnonce');
            $table->string('typeAnnonce');
            $table->string('typeConstruction');
            $table->string('nbPieces')->nullable();
            $table->string('surface')->nullable();
            $table->string('quartier');           
            $table->string('ville');
            $table->string('loyer')->nullable();
            $table->string('prix')->nullable();
            $table->text('description');
            $table->text('datePublication');
            $table->string('status');
            $table->integer('likes')->defaullt(0);
            $table->string('token');
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
        Schema::dropIfExists('annonces');
    }
}
