<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Empresa;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EmpresaFormRequest;
use DB;



class EmpresaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $empresas=DB::table('empresas')
                ->where('tipo','=','Tienda')
                ->orderBy('id','desc')
                ->paginate(7);
            
           
            return view('configuracion.tienda.index',["empresas"=>$empresas,"searchText"=>$query]);
        }
    }

    public function create(){
        return view('configuracion.tienda.create');
    }

    public function store(EmpresaFormRequest $request){
        $empresa = new Empresa;
        $empresa->nombre=$request->get('nombre');
        $empresa->tipo='Tienda';
        $empresa->email=$request->get('email');
        $empresa->telefono=$request->get('telefono');
        $empresa->direccion=$request->get('direccion');
        if($request->hasfile('logo')!=null){
            $file=$request->file('logo');
            $file->move(public_path().'\imagenes\logos\\',$file->getClientOriginalName());
        }
        $empresa->imagen=$file->getClientOriginalName();
        
        $empresa->save();

        

        return Redirect::to('configuracion/tienda');
}

    public function show($id){
        $categoria=DB::table('categorias')->where('idcategoria','=',$id);
        
        return view("almacen.categoria.show",["categoria"=>$categoria]);
    }

    public function edit($id){
        //$empresa=DB::table('empresas')->where('id','=',$id);
        
        return view("configuracion.tienda.edit",["empresa"=>Empresa::FindOrFail($id)]);
    }

    public function update(EmpresaFormRequest $request,$id){
        $empresa=Empresa::FindOrFail($id);
        $empresa->nombre=$request->get('nombre');
        $empresa->tipo='Tienda';
        $empresa->email=$request->get('email');
        $empresa->telefono=$request->get('telefono');
        $empresa->direccion=$request->get('direccion');
        if($request->hasfile('logo')!=null){
            $file=$request->file('logo');
            $file->move(public_path().'\imagenes\logos\\',$file->getClientOriginalName());
            $empresa->imagen=$file->getClientOriginalName();
        }
        
        $empresa->update();

        return Redirect::to('configuracion/tienda');
    }

    public function destroy($id){
        $categoria=Categoria::FindOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }

    
}
