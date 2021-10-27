{!! Form::open(array('url'=>'almacen/prenda','method'=>'GET','autocomplete'=>'off','role'=>'search'))!!}

<div class="form-group">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Buscar...." value="{{$searchText}}">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-info">Buscar</button>
        </span>
    </div>
</div>

{{Form::close()}}