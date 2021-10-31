@extends ('layouts.admin')
@section('contenido')
   <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Prenda</h3>
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
            {!!Form::open(array('url'=>'almacen/prenda','method'=>'POST','autocomplete'=>'off','file'=>'true','enctype'=>'multipart/form-data','class'=>'needs-validation'))!!}
            {{Form::token()}}

    <div class="row needs-validation">
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select name='idCategoria' class="form-control">
                        <option value="">Seleccionar....</option>
                        @foreach ($categorias as $cat)
                            <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="color">Color</label>
                <select name='idColor' class="form-control">
                    <option value="">Seleccionar....</option>
                @foreach ($colores as $col)
                        <option value="{{$col->id}}">{{$col->nombre}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input 
                        type="text" 
                        name="nombre" 
                        value="{{old('nombre')}}" 
                        class="form-control" 
                        placeholder="Nombre...." 
                        required 
                        onkeypress="return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90))"
                    >
                </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="material">Material</label>
                <select name='idMaterial' class="form-control">
                    <option value="">Seleccionar....</option>
                @foreach ($materiales as $m)
                        <option value="{{$m->id}}">{{$m->nombre}}</option>
                @endforeach
                </select>
            </div>
        </div>
       

        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="talle">Talle</label>
                <select name='idTalle' class="form-control">
                    <option value="">Seleccionar....</option>
                @foreach ($talles as $t)
                        <option value="{{$t->id}}">{{$t->unidad}}</option>
                @endforeach
                </select>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen"  class="form-control">
            </div>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Deatalle">Detalle</label>
                <input 
                    type="text" 
                    name="detalle" 
                    value="{{old('detalle')}}" 
                    class="form-control" 
                    placeholder="Detalle...." 
                    required 
                    onkeypress="return ((event.charCode >= 97 && event.charCode <= 122)||(event.charCode >= 65 && event.charCode <= 90))"
                >
            </div>
        </div>
    </div>
            
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
        {!!Form::close()!!}

@endsection