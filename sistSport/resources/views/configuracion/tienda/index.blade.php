@extends ('layouts.admin')
@section('contenido')

<div class="row">

    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>Configurar Tienda <a href="tienda/create"><button class="btn btn-primary">Nuevo</button></a></h3>
    </div>

</div>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    
                    <th>email</th>
                    <th>telefono</th>
                    <th>direccion</th>
                    <th>Opciones</th>
                </thead>
                @foreach ($empresas as $emp)
                    <tr>
                        
                        <td>
                            <img src="{{asset('imagenes\logos\\'.$emp->imagen)}}" alt="{{$emp->nombre}}" height="100px" width="100px" class="img-thumbnail">
                        </td>
                        <td>{{$emp->nombre}}</td>
                        
                        <td>{{$emp->email}}</td>
                        <td>{{$emp->telefono}}</td>
                        <td>{{$emp->direccion}}</td>
                        
                        <td>
                            <a href="{{URL::action('EmpresaController@edit',$emp->id)}}"><button class="btn btn-warning">Editar</button></a>
                            
                        </td>
                        
                    </tr>
               
                @endforeach
            </table>
        </div>
       
    </div>
    

</div>

@endsection