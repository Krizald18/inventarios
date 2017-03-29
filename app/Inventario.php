<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $casts = [
        'status' => 'boolean',
    ];

    protected $fillable = [
    	'id','numero_inventario','numero_serie', 'status','fecha_baja', 'comentario_baja', 'folio_resguardo', 'resguardo_id', 'modelo_id','oficialia_id', 'area_id', 'responsable_id'
    ]; 

    protected $hidden = [
	   'modelo_id','oficialia_id', 'area_id'
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
    public function getFolioResguardoAttribute($value)
    {
        return (string) $value;
    }
    /*
    public function subgrupo()
    {   
        return $this->hasOne('App\Descripcion', 'id', 'subgrupo_id');
    }*/
    public function modelo()
    {        
        return $this->hasOne('App\Modelo', 'id', 'modelo_id');
    }
    public function oficialia()
    {        
        return $this->hasOne('App\Oficialia', 'id', 'oficialia_id');
    }
    public function responsable()
    {        
        return $this->hasOne('App\Responsable', 'id', 'responsable_id');
    }
    public function area()
    {        
        return $this->belongsTo('App\Area', 'area_id', 'id');
    }
}