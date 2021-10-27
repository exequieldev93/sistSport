<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Talle;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TalleFormRequest;
use DB;

class TalleController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $talles=DB::table('talles')
            ->where('unidad','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);


            if($request->exists('pdf')){
                
                    return $this->download($talles);
            }
  
            return view('almacen.talle.index',["talles"=>$talles,"searchText"=>$query]);
        }
    }

    public function create(){
            return view('almacen.talle.create');
    }

    public function store(CategoriaFormResquest $request){
            $talle = new Talle;
            $talle->unidad=$request->get('unidad');
            $talle->condicion='1';
            $talle->save();

            return Redirect::to('almacen/talle');
    }

    public function show($id){
        $talle=DB::table('talles')->where('id','=',$id);
        
        return view("almacen.talle.show",["talle"=>$talle]);
    }

    public function edit($id){
        $categoria=DB::table('talles')->find($id);
        
        return view("almacen.talle.edit",["talle"=>$talle]);
    }
    
    public function update(TalleFormResquest $request,$id){
        $categoria=Talle::FindOrFail($id);
        $categoria->unidad=$request->get('unidad');
        $categoria->update();

        return Redirect::to('almacen/talle');
    }

    public function destroy($id){
        $categoria=Talle::FindOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/talle');
    }

    public function download($talle)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'talle'    =>   $talle
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.talle', $data);
        return $pdf->stream('mi-archivo.pdf');
    }
}
