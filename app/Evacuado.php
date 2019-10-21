<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evacuado extends Model
{
    public function evento()
    {
    	return $this->belongsTo(Evento::class);
    	
    }

    public function area()
    {
    	return $this->belongsTo(Area::class);
    	
    }

    public function reparto()
    {
    	return $this->belongsTo(Reparto::class);
    	
    }
}
