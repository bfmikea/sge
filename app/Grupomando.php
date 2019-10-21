<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupomando extends Model
{
    //Acá tengo que especificar la tabla pq laravel entiene que es grupomandos
    protected $table = 'gruposmando';

    public function evento()
    {
    	return $this->belongsTo(Evento::class);
    	
    }
}
