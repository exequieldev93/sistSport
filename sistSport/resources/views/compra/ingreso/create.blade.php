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
                        <label for="proveedor">Proveedor</label>
                        <select name="idproveedor" id="idproveedor" class="form-control">
                            @foreach ($empresas as $empresa)
                                <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" >
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
                                        @foreach ($prendas as $prenda)
                                            <option value="{{$prenda->idPrenda}}">{{$prenda->prendas}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="pcantidad">Cantidad</label>
                                <input type="number" name="pcantidad" id="pcantidad" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <label for="pprecio">Precio</label>
                                <input type="number" name="pprecio" id="pprecio" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-md-3 col-xs-12">
                            <div class="form-group">
                                <button type="buttom" id="bt_add" class="btn btn-primary">Agregar</button>
                            </div>
                        </div>

                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="datelles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                    <th>Opciones</th>
                                    <th>Prenda</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
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




                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <input name="_token" value="{{csrf_token()}}" type="hidden" >
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>
                </div>

            </div>


            

            {!!Form::close()!!}
      
@endsection