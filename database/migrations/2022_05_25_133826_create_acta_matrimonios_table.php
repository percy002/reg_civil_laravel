<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaMatrimoniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_matrimonios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_novio')->constrained('personas');
            $table->foreignId('fk_id_novia')->constrained('personas');            
            $table->string('acta');
            $table->string('libro');
            $table->date('fecha_registro')->format('d-m-Y');
            $table->date('fecha_matrimonio')->format('d-m-Y');
            $table->string('archivo');
            $table->boolean('rectificado')->nullable()->default(false);
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
        Schema::dropIfExists('acta_matrimonios');
    }
}
