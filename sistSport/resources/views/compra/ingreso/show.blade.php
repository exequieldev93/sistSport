@extends ('layouts.admin')
@section('contenido')
            <div class="row">

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="idProveedor">Proveedor</label>
                        <p>{{$ingreso->nombre}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <p>{{$ingreso->fecha}}</p>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-body">

                        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color: #A9D0F5">
                                  
                                    <th>Prenda</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>SubTotal</th>
                                </thead>
                                <tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                    <th>${{$ingreso->total}}</th>
                                </tfoot>
                                <tbody>
                                    @foreach ($detalles as $det)
                                        <tr>
                                            <td>{{$det->prenda}}</td>
                                            <td>{{$det->cantidad}}</td>
                                            <td>{{$det->precio}}</td>
                                            <td>${{$det->cantidad*$det->precio}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

@endsection