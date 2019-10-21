<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Gruposmando extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gruposmando', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cargo');
            // Añadimos la clave foránea con Evento. evento_id
            // Acordarse de añadir al array protected $fillable del fichero de modelo "Grupomando.php" la nueva columna:
            // protected $fillable = array('nombres','apellidos','cargo','evento_id');
            $table->integer('evento_id')->unsigned();
            // Indicamos cual es la clave foránea de esta tabla:
            $table->foreign('evento_id')->references('id')->on('eventos');
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
        Schema::dropIfExists('gruposmando');
    }
}
