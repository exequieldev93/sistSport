@extends ('layouts.admin')
@section('contenido')

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de materiales <a href="material/create"><button class="btn btn-primary">Nuevo</button></a></h3>
        @include('almacen.categoria.search')
        {!! Form::open(array('url'=>'almacen/material','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                    <input type="hidden"  name="searchText" value="{{$searchText}}">
                    <button type="submit" class="btn btn-primary" name="pdf">PDF</button>
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
                    <th>Nombre</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($materiales as $mat)
                    <tr>
                        <td>{{$mat->nombre}}</td>
                        <td>
                            <a href="{{URL::action('MaterialController@edit',$mat->id)}}"><button class="btn btn-primary">Edit</button></a>
                            <a href="" data-target="#modal-delete-{{$mat->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                @include('almacen.material.modal')
                @endforeach
            </table>
        </div>
        {{$materiales->render()}}
    </div>
    

</div>

@endsection