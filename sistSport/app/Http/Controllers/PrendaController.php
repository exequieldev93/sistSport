<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Prenda;
use App\Empresa;
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
            ->join('categorias as c','p.idCategoria','=','c.id')
            ->join('colores as col','p.idColor','=','col.id')
            ->join('talles as t','p.idTalle','=','t.id')
            ->join('materiales as m','p.idMaterial','=','m.id')
            ->select(
                    'p.id as idPrendas',
                    'c.nombre as categoria',
                    'col.nombre as color',
                    't.unidad as talle',
                    'm.nombre as material',
                    'p.nombre',
                    'p.detalle',
                    'p.imagen',
                    'p.estado'
                    )
            ->where('p.nombre','LIKE','%'.$query.'%')
            ->orwhere('c.nombre','LIKE','%'.$query.'%')
            ->orderBy('p.id','desc')
            ->paginate(7);
            
            //dd($prendas);
            if($request->exists('pdf')){
                $empresa = Empresa::findOrFail(23);
                return $this->download($prendas,$empresa);
            }
            
            return view('almacen.prenda.index',["prendas"=>$prendas,"searchText"=>$query]);
        }
    }

    public function create(){
            $categorias=DB::table('categorias')->where('condicion','=','1')->get();
            $colores=DB::table('colores')->where('condicion','=','1')->get();
            $talles=DB::table('talles')->where('condicion','=','1')->get();
            $materiales=DB::table('materiales')->where('condicion','=','1')->get();
            return view('almacen.prenda.create',["categorias"=>$categorias,"colores"=>$colores,"talles"=>$talles,"materiales"=>$materiales]);
    }

    public function store(PrendaFormRequest $request){

            $prendas = new Prenda;
            $prendas->idCategoria=$request->get('idCategoria');
            $prendas->nombre=$request->get('nombre');
            $prendas->idColor=$request->get('idColor');
            $prendas->idTalle=$request->get('idTalle');
            $prendas->idMaterial=$request->get('idMaterial');
            $prendas->detalle=$request->get('detalle');
            $prendas->estado='Activo';
            
            if($request->hasfile('imagen')!=null){
                $file=$request->file('imagen');
                $file->move(public_path().'\imagenes\prendas\\',$file->getClientOriginalName());
            }
            $prendas->imagen=$file->getClientOriginalName();
            $prendas->save();

            return Redirect::to('almacen/prenda');
    }

    public function show($id){
        $prendas=DB::table('prendas')->where('idcategoria','=',$id);
        
        return view("almacen.prenda.show",["prendas"=>$prendas]);
    }

    public function edit($id){
        $prenda=Prenda::findOrFail($id);
        $categorias=DB::table('categorias')->where('condicion','=','1')->get();
        
        return view("almacen.prenda.edit",["prenda"=>$prenda,"categorias"=>$categorias]);
    }
    
    public function update(PrendaFormRequest $request,$id){
        $prenda=Prenda::findOrFail($id);
        $prenda->idCategoria=$request->get('idCategoria');
        $prenda->nombre=$request->get('nombre');
        $prenda->talle=$request->get('talle');
        $prenda->detalle=$request->get('detalle');
        $prenda->color=$request->get('color');
        $prenda->estado='Activo';
        
           
        if($request->hasfile('imagen')!=null){
            $file=$request->file('imagen');
            $file->move(public_path().'\imagenes\prendas\\',$file->getClientOriginalName());
            $prenda->imagen=$file->getClientOriginalName();
        }
        
        $prenda->update();
        return Redirect::to('almacen/prenda');
    }

    public function destroy($id){
        $prenda=Prenda::findOrFail($id);
        $prenda->estado='Inactivo';
        $prenda->update();
        return Redirect::to('almacen/prenda');
    }

    public function download($prendas, Empresa $empresa)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'prendas'    =>   $prendas,
            'empresa'    =>   $empresa
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.prenda', $data);
        return $pdf->stream('mi-archivo.pdf');
    }
}
