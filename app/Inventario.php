<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
    	'id','numero_inventario','numero_serie','cantidad','descripcion_id','caracteristica_id','tipo_id','modelo_id','marca_id','oficialia_id','municipio_id','municipio_fisico_id','localidad_fisica_id'
    ]; 

    protected $hidden = [
		'descripcion_id','caracteristica_id','tipo_id','modelo_id','marca_id','oficialia_id','municipio_id','municipio_fisico_id','localidad_fisica_id'
    ];

    public function descripcion()
    {        
        return $this->hasOne('App\Descripcion', 'id', 'descripcion_id');
    }

    public function caracteristica()
    {        
        return $this->hasOne('App\Caracteristica', 'id', 'caracteristica_id');
    }

    public function tipo()
    {        
        return $this->hasOne('App\Tipo', 'id', 'tipo_id');
    }

    public function modelo()
    {        
        return $this->hasOne('App\Modelo', 'id', 'modelo_id');
    }

    public function marca()
    {        
        return $this->hasOne('App\Marca', 'id', 'marca_id');
    }

    public function oficialia()
    {        
        return $this->hasOne('App\Oficialia', 'id', 'oficialia_id');
    }

    public function municipio()
    {        
        return $this->hasOne('App\Municipio', 'id', 'municipio_id');
    }

    public function municipio_fisico()
    {        
        return $this->hasOne('App\Municipio', 'id', 'municipio_fisico_id');
    }

    public function localidad_fisica()
    {        
        return $this->hasOne('App\Localidad', 'id', 'localidad_fisica_id');
    }
}