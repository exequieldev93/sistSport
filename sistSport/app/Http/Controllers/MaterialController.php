<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Material;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\MaterialFormRequest;
use DB;

class MaterialController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $materiales=DB::table('materiales')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);


            if($request->exists('pdf')){
                
                    return $this->download($materiales);
            }
  
            return view('almacen.material.index',["materiales"=>$materiales,"searchText"=>$query]);
        }
    }

    public function create(){
            return view('almacen.material.create');
    }

    public function store(MaterialFormRequest $request){
            $material = new Material;
            $material->nombre=$request->get('nombre');
            $material->condicion='1';
            $material->save();

            return Redirect::to('almacen/material');
    }

    public function show($id){
        $material=DB::table('materiales')->where('id','=',$id);
        
        return view("almacen.material.show",["material"=>$material]);
    }

    public function edit($id){
        $material=DB::table('materiales')->find($id);
        
        return view("almacen.material.edit",["material"=>$material]);
    }
    
    public function update(MaterialFormRequest $request,$id){
        $material=Material::FindOrFail($id);
        $material->nombre=$request->get('nombre');
        $material->update();

        return Redirect::to('almacen/material');
    }

    public function destroy($id){
        $material=Material::FindOrFail($id);
        $material->condicion='0';
        $material->update();
        return Redirect::to('almacen/material');
    }

    public function download($materiales)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'materiales'    =>   $nateriales
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.material', $data);
        return $pdf->stream('mi-archivo.pdf');
    }
}
