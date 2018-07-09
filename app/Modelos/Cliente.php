<?php namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = 
    [
        'razon_social',
        'fecha_nacimiento',//FechaNacimiento
        'direccion',
        'comentario',
        'ruc',
        'activo'
    ];

    public function getFechaNacimientoAttribute($value)
    {
        if( $value != "")
            return \Carbon\Carbon::createFromFormat("Y-m-d", $value )->format("d/m/Y");
    }

    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = \Carbon\Carbon::createFromFormat("d/m/Y", $value )->format("Y-m-d");
    }

    public function setActivoAttribute($value)
    {
        $this->attributes['activo'] = ($value=='on');
    }

}
