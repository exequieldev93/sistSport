@extends ('layouts.admin')
@section('contenido')

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Listado de categorias <a href="categoria/create"><button class="btn btn-primary">Nuevo</button></a></h3>
        @include('almacen.categoria.search')
        {!! Form::open(array('url'=>'almacen/categoria','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}
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
                @foreach ($categorias as $cat)
                    <tr>
                        <td>{{$cat->nombre}}</td>
                        <td>
                            <a href="{{URL::action('CategoriaController@edit',$cat->id)}}"><button class="btn btn-primary">Edit</button></a>
                            <a href="" data-target="#modal-delete-{{$cat->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
                        </td>
                    </tr>
                @include('almacen.categoria.modal')
                @endforeach
            </table>
        </div>
        {{$categorias->render()}}
    </div>
    

</div>

@endsection