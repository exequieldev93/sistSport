<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Categoria;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaFormResquest;
use DB;

class CategoriaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $categorias=DB::table('categorias')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);

            if($request->exists('pdf')){
                
                    return $this->download($categorias);
            }
  
            
            
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }

    public function create(){
            return view('almacen.categoria.create');
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

    public function download($categorias)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'categorias'    =>   $categorias
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.categoria', $data);
        return $pdf->stream('mi-archivo.pdf');
    }
}
