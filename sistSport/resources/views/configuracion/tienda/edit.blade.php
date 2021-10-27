@extends ('layouts.admin')
@section('contenido')
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Tienda: {{$empresa->nombre}}</h3>
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
            {!!Form::model($empresa,['method'=>'PATCH','route'=>['tienda.update',$empresa->id],'file'=>'true','enctype'=>'multipart/form-data'])!!}
            {{Form::token()}}
            <div class="row">
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input 
                                type="text" 
                                name="nombre" 
                                value="{{$empresa->nombre}}" 
                                class="form-control" 
                                placeholder="Nombre...." 
                                required 
                                onkeypress="return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90))"
                            >
                        </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email"  value="{{$empresa->email}}" class="form-control" placeholder="Email....">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono"  value="{{$empresa->telefono}}" class="form-control" placeholder="Telefono....">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion"  value="{{$empresa->direccion}}" class="form-control" placeholder="Direccion....">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="logo">Imagen</label>
                        <input type="file" name="logo"  class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        @if (($empresa->imagen)!="")
                            <img src="{{asset('imagenes\prendas\\'.$empresa->imagen)}}" alt="{{$empresa->nombre}}" height="100px" width="100px" class="img-thumbnail">
                        @endif
                    </div>
                </div>
                
            </div>
                    
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="reset">Cancelar</button>
                    </div>

            {!!Form::close()!!}
      
@endsection