<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActaDefuncionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acta_defuncions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_id_fallecido')->constrained('personas')->unique();
            $table->string('acta');
            $table->string('libro');
            $table->date('fecha_registro')->format('d/m/Y');
            $table->date('fecha_defuncion')->format('d/m/Y')->nullable();
            $table->string('archivo');
            $table->boolean('rectificado')->nullable()->default(0);
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
        Schema::dropIfExists('acta_defuncions');
    }
}
