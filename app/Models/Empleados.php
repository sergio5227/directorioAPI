<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model {
    use HasFactory;
    protected $table = 'tbl_empleados_url';
    public $timestamps = false;
    protected $fillable = [
        'ID',
        'nombre',
        'extension',
        'sede',
        'ubicacion_piso',
        'puesto',
        'correo',
        'unidad_adtva',
        'imagen',
        'active'
    ];
}
