<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EvacuadosMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evacuados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ci');
            $table->string('nombres');
            $table->string('apellidos');
            // Añadimos la clave foránea con Fabricante. fabricante_id
            // Acordarse de añadir al array protected $fillable del fichero de modelo "Avion.php" la nueva columna:
            // protected $fillable = array('modelo','longitud','capacidad','velocidad','alcance','fabricante_id');
            $table->integer('reparto_id')->unsigned();
            // Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('reparto_id')->references('id')->on('repartos');
            $table->integer('edad');
            $table->string('sexo');
            $table->integer('area_id')->unsigned();
            // Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('area_id')->references('id')->on('areas');
            $table->string('local')->nullable();
            $table->integer('evento_id')->unsigned();
            // Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('evento_id')->references('id')->on('eventos');
            $table->string('observaciones')->nullable();

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
        Schema::dropIfExists('evacuados');
    }
}
