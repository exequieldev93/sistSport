<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Prenda;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PrendaFormRequest;
use DB;

class PrendaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $prendas=DB::table('prendas as p')
            ->join('categorias as c','a.idCategoria','=','c.id')
            ->select('a.idCategoria','a.nombre','a.talale','a.marca','a.color','a.imagen','c.nombre as categoria','a.esstado')
            ->where('nombre','LIKE','%'.$query.'%')
            ->orderBy('a.id','desc')
            ->paginate(7);

            //
            
            return view('almacen.prendas.index',["prendas"=>$prendas,"searchText"=>$query]);
        }
    }

    public function create(){
            $categorias=DB::table('categoria')->where('condicion','=','1')->get();
            return view('almacen.categoria.create',["categorias"=>$categorias]);
    }

    public function store(CategoriaFormResquest $request){
            $categoria = new Categoria;
            $categoria->nombre=$request->get('nombre');
            $categoria->condicion='1';
            $categoria->save();

            return Redirect::to('almacen/categoria');
    }

    public function show($id){
        $categoria=DB::table('categorias')->where('idcategoria','=',$id);
        
        return view("almacen.categoria.show",["categoria"=>$categoria]);
    }

    public function edit($id){
        $categoria=DB::table('categorias')->find($id);
        
        return view("almacen.categoria.edit",["categoria"=>$categoria]);
    }
    
    public function update(CategoriaFormResquest $request,$id){
        $categoria=Categoria::FindOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->update();

        return Redirect::to('almacen/categoria');
    }

    public function destroy($id){
        $categoria=Categoria::FindOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
}
