<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Color;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ColorFormRequest;
use DB;

class ColorController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            $colores=DB::table('colores')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('condicion','=','1')
            ->orderBy('id','desc')
            ->paginate(7);

            
            if($request->exists('pdf')){
                
                    return $this->download($colores);
            }
  
            return view('almacen.color.index',["colores"=>$colores,"searchText"=>$query]);
        }
    }

    public function create(){
            return view('almacen.color.create');
    }

    public function store(ColorFormRequest $request){
            $color = new Color;
            $color->nombre=$request->get('nombre');
            $color->condicion='1';
            $color->save();

            return Redirect::to('almacen/color');
    }

    public function show($id){
        $categoria=DB::table('colores')->where('id','=',$id);
        
        return view("almacen.color.show",["color"=>$categoria]);
    }

    public function edit($id){
        $categoria=DB::table('colores')->find($id);
        
        return view("almacen.color.edit",["color"=>$categoria]);
    }
    
    public function update(ColorFormResquest $request,$id){
        $color=Color::FindOrFail($id);
        $color->nombre=$request->get('nombre');
        $color->descripcion=$request->get('descripcion');
        $color->update();

        return Redirect::to('almacen/color');
    }

    public function destroy($id){
        $color=Color::FindOrFail($id);
        $color->condicion='0';
        $color->update();
        return Redirect::to('almacen/color');
    }

    public function download($color)
    {
        $pdf = \App::make('dompdf.wrapper');
        
        $data = [
            'color'    =>   $color
        ];
        $pdf->setPaper('A4', 'portrait');

        $pdf->loadView('reportes.color', $data);
        return $pdf->stream('mi-archivo.pdf');
    }
}
