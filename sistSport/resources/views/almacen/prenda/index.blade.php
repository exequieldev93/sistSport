@extends ('layouts.admin')
@section('contenido')

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de Prendas <a href="prenda/create"><button class="btn btn-primary">Nuevo</button></a></h3>
        @include('almacen.prenda.search')
        {!! Form::open(array('url'=>'almacen/prenda','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                    <input type="hidden"  name="searchText" value="{{$searchText}}">
                    <button type="submit" class="btn btn-success" name="pdf">PDF</button>
                </span>
            </div>
        </div>
        {{Form::close()}}
        
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Imagen</th>
                    <th>Categoria</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Detalle</th>
                    <th>Talle</th>
                    <th>Material</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($prendas as $pre)
                    <tr>
                        <td>
                            <img src="{{asset('imagenes\prendas\\'.$pre->imagen)}}" alt="{{$pre->nombre}}" height="100px" width="100px" class="img-thumbnail">
                        </td>
                        <td>{{$pre->categoria}}</td>
                        <td>{{$pre->nombre}}</td>
                        <td>{{$pre->color}}</td>
                        <td>{{$pre->detalle}}</td>
                        <td>{{$pre->talle}}</td>
                        <td>{{$pre->material}}</td>
                        <td>{{$pre->estado}}</td>
                        
                        <td>
                            <a href="{{URL::action('PrendaController@edit',$pre->idPrendas)}}"><button class="btn btn-warning">Editar</button></a>
                            <a href="" data-target="#modal-delete-{{$pre->idPrendas}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                @include('almacen.prenda.modal')
                @endforeach
            </table>
        </div>
        {{$prendas->render()}}
    </div>
    

</div>

@endsection