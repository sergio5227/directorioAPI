<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Empleados;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DirectorioController extends BaseController {

    public function index(){
        try {
            $elementos = DB::select('select * from tbl_empleados_url', []);
            return $this->sendResponse($elementos);
        } catch (\Throwable $th) {
            return $this->sendError('Error al recuperar el listado del directorio', $th, 500);
        }
    }

    public function show(Request $request, $id){
        try {
            $elementos = DB::select('select * from tbl_empleados_url where ID = ?', [$id]);
            return $this->sendResponse($elementos);
        } catch (\Throwable $th) {
            return $this->sendError('Error al recuperar el detalle del elemento', $th, 500);
        }
   }

    public function store(Request $request) {
        try {
            $input = $request->all();
            $validator = Validator::make($input, [
                'nombre' => 'required',
                'extension' => 'required',
                'sede' => 'required',
                'ubicacion_piso' => 'required',
                'puesto' => 'required',
                'correo' => 'required',
                'unidad_adtva' => 'required',
                'imagen' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->sendError('Todos los valores son requeridos', $validator->errors(), 500);
            }
            if ($request->file('imagen')->isValid()) {
                $lastId = DB::select('select * from tbl_empleados_url order by id desc');
                $nombre_archivo = preg_replace('/\s+/', '', $input['nombre']).'.'.$request->file('imagen')->extension();
                $nextId = $lastId[0]->id+1;
                $request->file('imagen')->storeAs('documentos/profiles_pics',$nombre_archivo);
                $save['ID']= $nextId;
                $save['nombre']= $input['nombre'];
                $save['extension']= $input['extension'];
                $save['sede']= $input['sede'];
                $save['ubicacion_piso']= $input['ubicacion_piso'];
                $save['puesto']= $input['puesto'];
                $save['correo']= $input['correo'];
                $save['unidad_adtva']= $input['unidad_adtva'];
                $save['imagen']= "http://localhost:8000/documentos/profiles_pics/".$nombre_archivo;
                $elemento = Empleados::create($save);

                return $this->sendResponse($elemento);

            }else{
                return $this->sendResponse('archivo no valido');
            }

        } catch (\Throwable $th) {
            return $this->sendError('Error al guardar la elemento', $th, 500);
        }
    }

    public function update(Request $request, Empleados $elemento){
       /*  try { */
            $input = $request->all();
            if (count($request->all()) === 0) {
                return $this->sendError('Al menos un valor es requerido');
            }
            $nombre_archivo = '';
            $nombre_archivo_guarda = '';
            if($input['imagen'] !== 'null'){
                $nombre_archivo =  "http://localhost:8000/documentos/profiles_pics/".preg_replace('/\s+/', '', $input['nombre']).'.'.$request->file('imagen')->extension();
                $nombre_archivo_guarda = preg_replace('/\s+/', '', $input['nombre']).'.'.$request->file('imagen')->extension();
            }else{
                $nombre_archivo = $input['imagenurl'];
            }
            $msj='Éxito al actualizar';
            $inputActualiza['id'] = $input['id'];
            $inputActualiza['nombre'] = $input['nombre'];
            $inputActualiza['extension'] = $input['extension'];
            $inputActualiza['sede'] = $input['sede'];
            $inputActualiza['ubicacion_piso'] = $input['ubicacion_piso'];
            $inputActualiza['puesto'] = $input['puesto'];
            $inputActualiza['correo'] = $input['correo'];
            $inputActualiza['unidad_adtva'] = $input['unidad_adtva'];
            $inputActualiza['imagen']=$nombre_archivo;
            if($input['imagen'] !== 'null'){
                $request->file('imagen')->storeAs('documentos/profiles_pics',$nombre_archivo_guarda);
            }
            $elemento->where('id', '=', $input['id'])->update($inputActualiza);
            return $this->sendResponse($msj);
        /* } catch (\Throwable $th) {
            return $this->sendError('Error al actualizar el elemento', $th, 500);
        } */
    }
    public function destroy($id){
        try {
            $elemento = Empleados::where('ID', $id)->get()->first();
            if($elemento){
                $elemento->where('ID', $id)->delete();
                return $this->sendResponse('elemento eliminado.');
            }else{
                return $this->sendError('Ese elemento no existe',null, 404);
            }
        } catch (\Throwable $th) {
            return $this->sendError('Error al eliminar el elemento', $th, 500);
        }
    }

}

