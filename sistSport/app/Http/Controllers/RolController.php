<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Rol;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\RolFormResquest;
use DB;

class RolController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $roles=DB::table('roles')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);

            
            return view('acceso.rol.index',["roles"=>$roles,"searchText"=>$query]);
        }
    }

    public function create(){
            return view('acceso.rol.create');
    }

    public function store(RolFormResquest $request){
            $rol = new Rol;
            $rol->nombre=$request->get('nombre');
            $rol->condicion='1';
            $rol->save();

            return Redirect::to('acceso/rol');
    }

    public function show($id){
        return view("almacen.rol.show",);
    }

    public function edit($id){
        
        
        return view("acceso.rol.edit");
    }
    
    public function update(RolFormResquest $request,$id){
        $rol=Rol::FindOrFail($id);
        $rol->nombre=$request->get('nombre');
        $rol->update();

        return Redirect::to('almacen/rol');
    }

    public function destroy($id){
        $rol=Rol::FindOrFail($id);
        $rol->condicion='0';
        $rol->update();
        return Redirect::to('almacen/rol');
    }

    
}
