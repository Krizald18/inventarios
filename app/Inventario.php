<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $casts = [
        
    ];

    protected $fillable = [
    	'id','numero_inventario','numero_serie','cantidad','fecha_baja','descripcion_id','caracteristica_id','tipo_id','modelo_id','marca_id','oficialia_id','municipio_id','municipio_fisico_id','localidad_fisica_id', 'area_id', 'responsable_id', 'grupo_id'
    ]; 

    protected $hidden = [
		'descripcion_id','caracteristica_id','tipo_id','modelo_id','marca_id','oficialia_id','municipio_id','municipio_fisico_id','localidad_fisica_id', 'area_id', 'responsable_id', 'grupo_id'
    ];

    public function getNumeroInventarioAttribute($value)
    {
        return is_null($value)? '': $value;
    }
    public function getNumeroSerieAttribute($value)
    {
        return is_null($value)? '': $value;
    }
    public function getCantidadAttribute($value)
    {
        return is_null($value)? '': $value;
    }
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
    public function responsable()
    {        
        return $this->hasOne('App\Responsable', 'id', 'responsable_id');
    }
    public function grupo()
    {        
        return $this->belongsTo('App\Grupo', 'grupo_id', 'id');
    }
    public function area()
    {        
        return $this->belongsTo('App\Area', 'area_id', 'id');
    }
}