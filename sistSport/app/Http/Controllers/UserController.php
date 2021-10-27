<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $usuarios=DB::table('users')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);

            

            if($request->exists('pdf')){
                
                    return $this->download($categorias);
            }
  
            return view('acceso.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }

    public function create(){
            $roles = DB::table('roles')-where('condicion','=','1')->get();
            return view('acceso.usuario.create',"roles"->$reles);
    }

    public function store(CategoriaFormResquest $request){
            $usurio = new User;
            $usuario->nombre=$request->get('nombre');
            $usuario->email=$request->get('email');
            $usuario->password=$request->get('password');
            $usuario->idRol=$request->get('idRol');
            $usuario->condicion='1';

            $categoria->save();

            return Redirect::to('acceso/usuario');
    }
 /*
    public function show($id){
        $categoria=DB::table('categorias')->where('idcategoria','=',$id);
        
        return view("acceso.usuario.show",["categoria"=>$categoria]);
    }*/

    /*
    public function edit($id){
        $categoria=DB::table('categorias')->find($id);
        
        return view("acceso.usuario.edit",["categoria"=>$categoria]);
    }
    
    public function update(CategoriaFormResquest $request,$id){
        $categoria=Categoria::FindOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->update();

        return Redirect::to('acceso/usuario');
    }

    public function destroy($id){
        $categoria=Categoria::FindOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('acceso/usuario');
    }

    public function download($categorias)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'categorias'    =>   $categorias
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.categoria', $data);
        return $pdf->stream('mi-archivo.pdf');
    }*/
}
