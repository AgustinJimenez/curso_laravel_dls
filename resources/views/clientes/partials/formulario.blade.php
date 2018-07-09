{!! csrf_field() !!}
<div class="row">

    <div class="col-md-2">
        <div class="form-group">
            <label>Razon Social</label>
        <input type="text" class="form-control" name="razon_social" required="required" size="10" value="{{ $cliente->razon_social }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" class="form-control" name="direccion" value="{{ $cliente->direccion }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>RUC</label>
            <input type="text" class="form-control" name="ruc" value="{{ $cliente->ruc }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label>Fecha Nacimiento</label>
            <input type="text" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" readonly="readonly" style="background-color: white" value="{{ $cliente->fecha_nacimiento }}">
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <br>
            <label>Activo</label>
            <input type="checkbox" name="activo" @if($cliente->activo) checked  @endif >
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>Comentario</label>
            <textarea class="form-control" name="comentario">{{ $cliente->comentario }}</textarea>
        </div>
    </div>
</div>