@extends ('layouts.admin')
@section('contenido')
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Articulo: {{$prenda->nombre}}</h3>
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
            {!!Form::model($prenda,['method'=>'PATCH','route'=>['prenda.update',$prenda->id],'file'=>'true','enctype'=>'multipart/form-data'])!!}
            {{Form::token()}}
            <div class="row">
                
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select name='idCategoria' class="form-control">
                                @foreach ($categorias as $cat)
                                    @if($cat->id == $prenda->idCategoria)
                                    <option value="{{$cat->id}}" selected>{{$cat->nombre}}</option>
                                    @else
                                    <option value="{{$cat->id}}" selected>{{$cat->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" name="color"  value="{{$prenda->color}}" class="form-control" >
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="Nombre">Nombre</label>
                            <input type="text" name="nombre" required value="{{$prenda->nombre}}" class="form-control" >
                        </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen"  class="form-control" >
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="talle">Talle</label>
                        <input type="text" name="talle" required value="{{$prenda->talle}}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        @if (($prenda->imagen)!="")
                            <img src="{{asset('imagenes\prendas\\'.$prenda->imagen)}}" alt="{{$prenda->nombre}}" height="100px" width="100px" class="img-thumbnail">
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