<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaNacimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_nacimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_nacido')->constrained('personas')->unique();
            $table->string('acta');
            $table->string('libro');
            $table->foreignId('fk_id_padre')->constrained('personas')->nullable();
            $table->foreignId('fk_id_madre')->constrained('personas')->nullable();
            $table->date('fecha_registro');
            $table->date('fecha_nacimiento');
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
        Schema::dropIfExists('acta_nacimientos');
    }
}
