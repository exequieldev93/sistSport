<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\CategoriaFormResquest;
use App\Ingreso;
use App\DeatalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){

        if($request){
            //Filtro de busqueda
            $query=trim($request->get('searchText'));

            //Consulta a la base de datos
            /*
            $ingresos=DB::table('ingresos as i')
            ->join('empresas as e','i.idProveedor','=','e.id')
            ->join('detalle_ingresos as di','i.id','=','di.idIngreso')
            ->select('i.id as ingreso','i.fecha_hora','a.nombre','i.estado',DB::raw('sum(di.cantidad*di.precio) as total'))
            ->orderBy('ingreso','desc')
            ->groupBy('i.id as ingreso','i.fecha_hora','a.nombre','i.estado')
            ->paginate(7);*/

            $ingresos=DB::table('ingresos as i')
            ->join('empresas as e','i.idProveedor','=','e.id')
            ->join('detalle_ingresos as di','di.idIngreso','=','i.id')
            ->select(
                        'i.id',
                        'i.fecha',
                        'e.nombre as proveedor',
                        DB::raw('sum(di.cantidad*di.precio) as total')
                    )
            ->where('e.tipo','=',1)
            ->orderBy('i.id','desc')
            ->groupBy('i.id','i.fecha','i.fecha','i.estado','e.nombre')
            ->paginate(7);


            //dd($ingresos);

            if($request->exists('pdf')){
                
                    return $this->download($ingreso);
            }
  
            return view('compra.ingreso.index',["ingresos"=>$ingresos,"searchText"=>$query]);
        }
    }

    public function create(){

        $empresas=DB::table('empresas')
                ->where('tipo','=',1)->get();

        $prendas = DB::table('prendas as pre')
        ->join('categorias as c','c.id','=','pre.idCategoria')
        ->join('colores as co','co.id','=','pre.idColor')
        ->select(
                DB::raw('CONCAT(c.nombre," ",co.nombre) as prendas'),
                'pre.id as idPrenda'
                )
        ->where('pre.estado','=','Activo')
        ->get();

        
        return view('compra.ingreso.create',["empresas"=>$empresas,"prendas"=>$prendas]);
    }

    public function store(IngresoFormRequest $request){
        
        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->idProveedor = $request->get('idProveedor');
            $ingreso->fecha=$request->get('fecha');
            $ingreso->estado = 1;
            $ingreso->save();

            $idprenda = $request->get('idPrenda');
            $cantidad = $request->get('cantidad');
            $precio = $request->get('precio');

            $cont = 0;

            while($cont < count($idPrenda)){
                $detalle = new DetalleIngreso();
                $detalle->idIngreso=$ingreso->id;
                $detalle->idPrenda=$idprenda[$cont];
                $detalle->idTalle=$idtalle[$cont];
                $detalle->precio=$precio[$cont];
                $cont=$cont+1;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB:: rollnack();
        }

        return Redirect::to('compra/ingreso');
    }

    public function show($id){
        $ingreso=DB::table('ingresos as i')
            ->join('empresas as e','i.idProveedor','=','e.id')
            ->join('detalle_ingresos as di','i.id','=','di.idIngreso')
            ->select('i.id as ingreso','i.fecha_hora','a.nombre','i.estado',DB::raw('sum(di.cantidad*di.precio) as total'))
            ->where('idIngreso','=',$id)
            ->first();

        $detalle=DB::table('detalle_ingreso as d')
            ->join('prendas as p','d.idPrenda','=','p.id')
            ->select('a.nombre as prenda','d.cantidad','d.precio')
            ->where('d.idIngreso','=',$id)
            ->get();
        
        return view("compra.ingreso.show",["ingreso"=>$ingreso,"detalle"=>$detalle]);
    }


    public function destroy($id){
        $ingreso=Ingreso::FindOrFail($id);
        $ingreso->estado=0;
        $ingreso->update();
        return Redirect::to('comprar/ingreso');
    }

}
