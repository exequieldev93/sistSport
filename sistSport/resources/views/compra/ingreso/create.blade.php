@extends ('layouts.admin')
@section('contenido')
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Nueva Ingreso</h3>
                @if (count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        
                    </ul>
                </div>
                @endif
        </div>
   </div>
            {!!Form::open(array('url'=>'compra/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

            <div class="row">

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="idProveedor">Proveedor</label>
                        <select name="idProveedor"  class="form-control">
                            <option value="">Seleccionar....</option>
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" name="fecha" >
                    </div>
                </div>

            </div>
            
            <div class="row">

                <div class="panel panel-primary">
                    <div class="panel-body">

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="pidPrenda">Articulo</label>
                                <select name="pidPrenda" id="pidPrenda" class="form-control">
                                        <option value="">Seleccionar....</option>
                                        @foreach ($prendas as $prenda)
                                            <option value="{{$prenda->idPrenda}}">{{$prenda->prendas}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="pidmarca">Marcas</label>
                                <select name="pidmarca" id="pidmarca" class="form-control">
                                        <option value="">Seleccionar....</option>
                                        @foreach ($marcas as $marca)
                                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label for="pcantidad">Cantidad</label>
                                <input type="number" name="pcantidad" id="pcantidad" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-3 col-md-2 col-xs-12">
                            <div class="form-group">
                                <label for="pprecio">Precio</label>
                                <input type="number" name="pprecio" id="pprecio" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                            <div class="form-group">
                                <button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Prenda</th>
                                    <th>Talle</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th id="total">00.0</th>
                                </tfoot>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



                
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
                    <div class="form-group">
                        <input name="_token" value="{{csrf_token()}}" type="hidden" >
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
                </div>

            </div>


            

            {!!Form::close()!!}

@push('scripts')
<script>
    $(document).ready(function(){
        $('#bt_add').click(function(){
            agregar();
        });
    });
    var cont=0;
    total=0;
    subtotal=[];
    $("#guardar").hide();

    function agregar(){
        idprenda=$("#pidPrenda").val();
        prenda=$("#pidPrenda option:selected").text();
        idmarca=$("#pidmarca").val();
        marca=$("#pidmarca option:selected").text();
        cantidad=$("#pcantidad").val();
        precio=$("#pprecio").val();

        if(idprenda!="" && cantidad!="" && cantidad>0 && precio!="" && idmarca!="")
        {
            subtotal[cont]=(cantidad*precio);
            total=total+subtotal[cont];

            var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idprenda[]" value="'+idprenda+'" >'+prenda+'</td><td><input type="hidden" name="idmarca[]" value="'+idmarca+'" >'+marca+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'" ></td><td><input type="number" name="precio[]" value="'+precio+'" ></td><td>'+subtotal[cont]+'</td></tr>';
            cont++;
            limpiar();
            $("#total").html("$" + total);
            evaluar();
            $('#detalles').append(fila);
        }else{
            alert("Error al ingresar el detalle, revise los datos del articulo");
        }
    }

    function limpiar(){
        $("#pcantidad").val("");
        $("#pprecio").val("");
    }

    function evaluar(){
        if(total>0){
            $("#guardar").show();
        }
        else{
            $("#guardar").hide();
        }
    }

    function eliminar(index){
        total=total-subtotal[index];
        $("#total").html("$"+total);
        $("#fila" + index).remove();
        evaluar();
    }
</script>
@endpush
@endsection